<?php
require_once 'header.html';
require_once 'functions/functions.php';
$i = 0; // for counter
$arrayCount = 0; // Amount of elements in an Array
$insideNetwork = ""; // Inside subnet RFC1918
$insideMask = ""; // subnet maks for Inside subnet
$mapNumber = ""; // Crypto map number from ASA
$outsideIP = ""; // Outside IP for access
$preShareKey = ""; // Hold the VPN tunnel pasword 
$regionName = ""; // Used for region name
$tempInNetwork = ""; //Array used to store insude network IPs
$tempShare = ""; // Array to hold the region name once exploded by PHP 
$fail = "";
$field = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['regionName']))
    {
        $regionName = strtoupper($_POST['regionName']);
        $tempShare = explode(".", $regionName);
        $preShareKey = $tempShare[0] . $tempShare[2] . "!";
	$preShareKey = strtolower($preShareKey);
    }
    if (isset($_POST['insideNetwork']))
    {
        $insideNetwork = $_POST['insideNetwork'];
	$tempInNetwork = explode(",", $insideNetwork);
        $arrayCount = count($tempInNetwork);
    }
    if (isset($_POST['insideMask']))
    {http://ct/asa.php
        $insideMask = $_POST['insideMask'];
    }
    if (isset($_POST['outsideIP']))
    {
        $outsideIP = $_POST['outsideIP'];
    }
    if (isset($_POST['mapNumber']))
    {
	$mapNumber = $_POST['mapNumber'];
    }
    
$fail = validate_regionName($regionName);
$fail .= validateOutsideIP($outsideIP);
$fail .= validateInsideMask($insideMask);
$fail .= validateVLAN($mapNumber);

echo "<html><head><title>An Example Form</title>";

    if ($fail == "") {
	echo "</head><body>Form data successfully validated for: $regionName </body></html>";
    
	// Start to print the ASA rules
	if ($arrayCount > 0)
	{
	    echo "<textarea rows='18' cols='130'>";
	    for ($i=0; $i<$arrayCount;$i++)
	    {
		    echo "access-list" . " " .  $regionName . " " .  "extended permit ip 64.28.208.0 255.255.255.192  ".$tempInNetwork[$i] . " " . $insideMask . "\n";
	    }
	echo "\n";
	echo "crypto map outside_map" . " " . $mapNumber . " " . "match address" . " " . $regionName . "\n";
	echo "crypto map outside_map" . " " . $mapNumber . " " . "set peer" . " " . $outsideIP . "\n";
	echo "crypto map outside_map" . " " . $mapNumber . " " . "set transform-set ESP-DES-MD5" . "\n";
	echo "\n";
	echo "tunnel-group" . " " . $outsideIP . " " . "type ipsec-l2l" . "\n";
	echo "tunnel-group" . " " . $outsideIP . " " . "ipsec-attributes" . "\n";
	echo "pre-shared-key" . " " . $preShareKey . "\n";
	echo "</textarea>";
	}
    require_once 'footer.html';
    exit;
    } 

}

echo <<<_END
<p>$fail</p>

<br />
<form action="asa.php" method="post" onSubmit="return validate(this)">
Region: <input type='text' size="20" maxlength='50' name='regionName' value='$regionName' /><br />
Outside IP: <input type='text' size="20" maxlength='50' name='outsideIP' value='$outsideIP' /><br />
Enter multiple Inside networks  by putting a comma after the network e.g. IP<strong>,</strong>IP<strong>,</strong>IP- only works with IP not masks <br />
Inside Network IP: <input type='text' size="20" maxlength='150' name='insideNetwork' value='$insideNetwork' />
Mask: <input type='text' size="20" maxlength='50' name='insideMask' value='$insideMask' /><br />
Map #: <input type='text' size="10" maxlength='10' name='mapNumber' value='$mapNumber' /><br />
<input type='submit' value='submit' />
</form>

<script type="text/javascript">
function validateRegionname(field) {
	if (field == "") return "No Region Name was entered.\\n"
	return ""
}
</script>
</body>
</html>
_END;



?>
