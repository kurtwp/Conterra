<?php
require_once 'header.html';
//require_once 'functions/metronidFunctions.php';
//$i = 0; // for counter
//$arrayCount = 0; // Amount of elements in an Array
$circID = ""; // Citcuit ID
$gateIP = ""; // Gateway IP 
$hostName =""; // Host Name for MetroNID
$manaIP = ""; // MetroNID Management IP address
$manaMask = ""; // MetroNID Management Subnet Mask
$fail = "";
//$field = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['hostName']))
    {
        $hostName = strtoupper($_POST['hostName']);
    }
    if (isset($_POST['manaIP']))
    {
        $manaIP = $_POST['manaIP'];
    }
    if (isset($_POST['manaMask']))
    {
        $manaMask = $_POST['manaMask'];
    }
    if (isset($_POST['circID']))
    {
        $circID = strtoupper($_POST['circID']);
    }
    if (isset($_POST['gateIP']))
    {
		$gateIP = $_POST['gateIP'];
    }

	if ($fail == "") {
		// Start to print the MetroNID configuration
		echo "</head><body>Form data successfully validated for: $hostName </body></html>";
		echo "<textarea rows='18' cols='130'>";
		echo "session writelock " . "\n";
		echo "interface edit Management dhcp disable" . "\n";
		echo "interface edit Network dhcp disable" . "\n";
		echo "interface edit Management address " . $manaIP . " netmask " . $manaMask . " gateway " . $gateIP . "\n";
		echo "interface edit Auto state disable" . "\n";
		echo "dns edit hostname $hostName.ND01" . "\n";
		echo " Circuit ID = " . $circID . "\n";
		
		echo "</textarea>";
		require_once 'footer.html';
		exit;
	}
	
		
}

echo <<<_END
<p>$fail</p>
<br />
<form name="form" action="metronid.php" method="post" onSubmit="return metronidValidate();">
Management IP: <input type='text' size="20" maxlength='50' name='manaIP' value='$manaIP' /><br />
Management Mask: <input type='text' size="20" maxlength='50' name='manaMask' value='$manaMask' /><br />
Gateway IP: <input type='text' size='20' maxlength='30' name'gateIP' value='$gateIP' /><br />
Host Name: <input type='text' size="20" maxlength="25" name='hostName' value='$hostName' /><br />
Circuit ID: <input type='text' size="10" maxlength="15" name='circID' value='$circID' /><br />
<input type='submit' value='submit' />
</form>

</body>
</html>
_END;

require_once 'footer.html';

?>
