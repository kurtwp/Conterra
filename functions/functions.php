<?php

// Validate VlAN
function validateVLAN($vlan) {
    
    // Reg Ex checks for postive numbers only
    $regexp = '/^\d+$/';
    
    if ($vlan == "")
    {
	return "Please enter a VLAN Number !<br />";
    }
    if (preg_match($regexp, $vlan))
    {
	return "";
    } else {
	return "VLAN ID must all numbers !";
    }
  
}
// Validate Region Name
function validate_regionName($field) {
    	if ($field == "") return "Please enter a Region Name !<br />";
	return "";
}
//Validates Inside Masks
function validateInsideMask($mask)
{
    $octect = array(0,128,192,224,240,248,252,254,255);

    if ($mask == "")
    {
	return "Please enter an Inside Mask !<br />";
    }
    
    $tempArray = explode(".",$mask);
    $tempArrayCount = count($tempArray);
    If ($tempArrayCount < 4 || $tempArrayCount > 4)
    {
        return "Invalid Mask";
    }
    if ($tempArrayCount == 4)
    {
	for ($i=0; $i<3; $i++)
        {
            if ($tempArray[$i] != 255 || $tempArray[3] == "")
            {
                return "The Fist 3 octets need to be 255";
            }
        }
    }
    if ($tempArrayCount == 4)
    {
        for ($k=0;$k<10;$k++)
        {
            
            if ($octect[$k] == $tempArray[3])
	    {
		return "";
	    }
        }
        if ($k == 10)
        {
            return "Fouth octect is invalid";
        }
    } 
}
// Validates Outside IP
function validateOutsideIP($ip)
{
    $regexp = '/^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/';
    
    if (preg_match($regexp, $ip))
    {
        return "";
    } elseif ($ip == "") {
	return "Please enter an Outside IP address ! <br />";
    } else {
	return "Outside IP not valid ! <br />";
    }
    
    
}
function validateInsideIP($ip)
{
    $regexp = '/^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/';
    
    if (preg_match($regexp, $ip))
    {
        return "";
    } elseif ($ip == "") {
	return "Please enter an Inside IP address ! <br />";
    } else {
	return "Inside IP not valid ! <br />";
    }
    
    
}
// Validate Inside IP

//orignal validateIP functions
/* function validateIP($ip)
{
   
    $valid = false;
    
    $regexp = '/^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/';
    
    if (preg_match($regexp, $ip))
    {
        $valid = true;
    }
    
    return $valid;
}
How to use validateIP functions
$ip = "10.10.10.255";

$results = validateIP($ip);
if ($results) {
    echo "valid IP";
} else {
    echo "Not valid";
}  */


?>