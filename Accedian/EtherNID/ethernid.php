<?php
require_once '../../header.html';
require_once 'functions/etherFunctions.php';
//$i = 0; // for counter
$arrayCount = 0; // Amount of elements in an Array
$circID = ""; // Citcuit ID
$gateIP = ""; // Gateway IP 
$hostName =""; // Host Name for MetroNID
$manaIP = ""; // MetroNID Management IP address
$manaMask = ""; // MetroNID Management Subnet Mask
$ntpIP = ""; // NTP server IP - Usually the MetroNID Managment IP
$tempCircID = ""; // Place holder after explode function
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
		$tempCircID = explode(",",$circID);
		$arrayCount = count($tempCircID);
	}
	if (isset($_POST['gateIP']))
	{
		$gateIP = $_POST['gateIP'];
	}
	if (isset($_POST['ntpIP']))
	{
		$ntpIP = $_POST['ntpIP'];
	}
	
$fail = validateHostName($hostName);
$fail .= validateManagementIP($manaIP);
$fail .= validateManagementMask($manaMask);
$fail .= validateCircuitID($circID);
$fail .= validateGatewayIP($gateIP);
$fail .= validateNTPIP($ntpIP);

	if ($fail == "") {
		// Start to print the MetroNID configuration
		echo "</head><body><div id=container>Form data successfully validated for: $hostName <br />";
		print "<textarea name='nowrap' rows='40' cols='130'>";
		print "session writelock " . "\n";
		print "interface edit Management dhcp disable" . "\n";
		print "interface edit Network dhcp disable" . "\n";
		print "interface edit Management address " . $manaIP . " netmask " . $manaMask . " gateway " . $gateIP . "\n";
		print "dns edit hostname $hostName.ND01" . "\n";
		print "snmp edit ro-community 1234!" . "\n";
		print "snmp edit rw-community 1234!!\n";
		print "snmp edit use-host-name enable\n";
		print "snmp edit state enable\n";
		print "history edit local state enable\n";
		print "history edit local paa-period 1\n";
		print "history edit local paa-filing enable\n";
		print "history edit local regulator-filing enable\n";
		print "history edit local regulator-period 1\n";
		print "history edit file url ftp://conterra:c0nterraOC!@64.28.208.26/nid-uploads\n";
		print "history edit file period-mode new\n";
		print "history edit file include-previous enable\n";
		print "history edit scheduling local-minutes 00H00,00H15,00H30,00H45\n";
		print "history edit scheduling local-hours 00H00,01H00,02H00,03H00,04H00,05H00,06H00,07H00,08H00,09H00,10H00,11H00,12H00,13H00,14H00,15H00,16H00,17H00,18H00,19H00,20H00,21H00,22H00,23H00\n";
		print "history edit scheduling local-state enable\n";
		print "bandwidth-regulator add 20MB cir 20000 cbs 8 eir 1000 ebs 8 color-mode blind coupling-flag false\n";
		if ($arrayCount > 0) {
			for ($i=0; $i<$arrayCount; $i++) {
				print "bandwidth-regulator add $tempCircID[$i] cir 100000 cbs 64 eir 1000 ebs 64 color-mode blind coupling-flag false\n";
			}
		}
		print "bandwidth-regulator add 100MB cir 100000 cbs 8 eir 1000 ebs 8 color-mode blind coupling-flag false\n";
		print "bandwidth-regulator add 1000MB cir 1000000 cbs 8 eir 1000 ebs 8 color-mode blind coupling-flag false\n";
		print "ntp delete ca.pool.ntp.org\n";
		print "ntp delete us.pool.ntp.org\n";
		print "media-selection select SFP-A_SFP-B\n";
		print "ntp enable-server\n";
		print "user edit admin password\n";
		print "password\n";
		print "password\n";
		print "port edit Network mtu 9012\n";
		print "port edit Client mtu 9012\n";
		print "ntp disable-server\n";
		print "ntp add $ntpIP\n";
		print "ntp enable $ntpIP\n";
		print "session edit timeoutweb 900\n";
		print "session edit timeoutcli 900\n";
		print "oam add loopback port Network\n";
		print "loopback edit loopback state enable remote-lpbk-acterna enable\n";
		print "loopback edit loopback remote-lpbk-oam enable\n";
		print "loopback edit loopback remote-lpbk-veex enable\n";
		print "loopback edit loopback remote-lpbk-sunrise enable\n";
		print "loopback edit loopback tagged-cmds enable\n";
		echo "</textarea>";
		echo "</div>";
		require_once '../../footer.html';
		exit;
	}
	
		
}

echo <<<_END
<div id=container>
<p>$fail</p>
<br />
<form id="contactform" name="form" action="ethernid.php" method="post" onSubmit="return ethervalidate(this);">
<h3>Accedian EtherNID</h3>
<div class="field">
	<label for="manaIP" >Management IP: </label>
	<input type='text' class='input' size="20" maxlength='50' name='manaIP' value='$manaIP' /><br />
</div>
<div class="field">
	<label for="manaMask" >Management Mask: </label>
	<input type='text' class='input' size="20" maxlength='50' name='manaMask' value='$manaMask' /><br />
	<br />
</div>
<div class="field">
	<label for="gateIP" >Gateway IP: </label>
	<input type='text' class='input' size='20' maxlength='30' name='gateIP' value='$gateIP' /><br />
</div>
<div class="field">
	<label for="hostName">Host Name: </label>
	<input type='text' class='input' size="20" maxlength="25" name='hostName' value='$hostName' /><br />
</div>
<div class="field">
	<label for="circID">Circuit ID: </label>
	<input type='text' class='input' size="10" maxlength="50" name='circID' value='$circID' /><br />
	<p class='hint'>To enter in multiple Circuit ID use "," in between:<br />
	CTS11223,CTS11817,CTS11525</p>
</div>
<div class="field">
	<label for="ntpIP">NTP Server IP: </label>
	<input type='text' class='input' size='10' maxlength='20' name='ntpIP' value='$ntpIP' /><br />
	<p class='hint'>Same as the MetroNID Manament IP</p>
</div>
<input type='submit' class='button' value='submit' />
</form>
</div>
_END;

require_once '../../footer.html';

?>
