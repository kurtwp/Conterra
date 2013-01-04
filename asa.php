<?php

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


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['regionName'])
    {
        $regionName = strtoupper($_POST['regionName']);
        $tempShare = explode(".", $regionName);
        $preShareKey = $tempShare[0] . $tempShare[2] . "!";
  $preShareKey = strtolower($preShareKey);
    }
    if ($_POST['insideNetwork'])
    {
        //$insideNetwork = $_POST['insideNetwork'];
        $tempInNetwork = explode(",", $_POST['insideNetwork']);
        $arrayCount = count($tempInNetwork);
    }
    if ($_POST['insideMask'])
    {
        $insideMask = $_POST['insideMask'];
    }
    if ($_POST['outsideIP'])
    {
        $outsideIP = $_POST['outsideIP'];
    }
    if ($_POST['mapNumber'])
    {
	$mapNumber = $_POST['mapNumber'];
    }
}
// Start to print the ASA rules
if ($arrayCount > 0)
{
    echo "<pre>";
    for ($i=0; $i<$arrayCount;$i++)
    {
            echo "access-list" . " " .  $regionName . " " .  "extended permit ip 64.28.208.0 255.255.255.192  ".$tempInNetwork[$i] . " " . $insideMask . "<br />";
    }
echo "<br />";
echo "crypto map outside_map" . " " . $mapNumber . " " . "match address" . " " . $regionName . "<br />";
echo "crypto map outside_map" . " " . $mapNumber . " " . "set peer" . " " . $outsideIP . "<br />";
echo "crypto map outside_map" . " " . $mapNumber . " " . "set transform-set ESP-DES-MD5" . "<br />";
echo "<br />";
echo "tunnel-group" . " " . $outsideIP . " " . "type ipsec-l2l" . "<br />";
echo "tunnel-group" . " " . $outsideIP . " " . "ipsec-attributes" . "<br />";
echo "pre-shared-key" . " " . $preShareKey . "<br />";
echo "</pre>";
}

echo <<<_END
<form action="firewall2.php" method="post">
Region: <input type='text' size="20" maxlength='50' name='regionName' value='$regionName' /><br />
Outside IP: <input type='text' size="20" maxlength='50' name='outsideIP' value='$outsideIP' /><br />
Enter multiple Inside networks  by putting a comma after the network e.g. IP<strong>,</strong>IP<strong>,</strong>IP- only works with IP not masks <br />
Inside Network IP: <input type='text' size="20" maxlength='50' name='insideNetwork' value='$insideNetwork' />
Mask: <input type='text' size="20" maxlength='50' name='insideMask' value='$insideMask' /><br />
Map #: <input type='text' size="10" maxlength='10' name='mapNumber' value='$mapNumber' /><br />
<input type='submit' value='submit' />
</form>
_END;

?>
