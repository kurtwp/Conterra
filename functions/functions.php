<?php

// Validate VlAN
function validateVLAN($vlan) {
    
    $regexp = '/^\d+$/';
    
    if ($vlan == "")
    {
	return "Please enter a VLAN Number<br />";
    }
    if (preg_match($regexp, $vlan))
    {
	return "";
    } else {
	return "No a number";
    }
  
}
// Validate Region Name
function validate_regionName($field) {
    	if ($field == "") return "No Region Name was entered<br />";
	return "";
}
//Validates Inside Masks
function validateInsideMask($mask)
{
    $octect = array(0,128,192,224,240,248,252,254,255);

    if ($mask == "")
    {
	return "No Inside Mask was entered <br />";
    }
    
    $tempArray = explode(".",$mask);
    $tempArrayCount = count($tempArray);
    If ($tempArrayCount < 4 || $tempArrayCount > 4) {
        return "Invalid Mask";
    } elseif ($tempArrayCount == 4) {
	for ($i=0; $i<3; $i++)
        {
            if ($tempArray[$i] != 255)
            {
                return "The Fist 3 octets need to be 255";
            }
        }
    } elseif ($tempArray[3] != "") {
	for ($k=0;$k<10;$k++)
	{
	    if ($octect[$k] == $tempArray[3])
	    {
		return "";
	    }
	}
    } else {
	return "Fouth Octet if wrong";
    }
	
	/*
        for ($i=0; $i<3; $i++)
        {
            if ($tempArray[$i] != 255)
            {
                return "The Fist 3 octets need to be 255";
            }
        }
	for ($k=0;$k<10;$k++)
	{
	    if ($tempArray[3] == "")
	    {
		return "Missing Fouth Octect";
	    }
	    elseif ($octect[$k] == $tempArray[3])
	    {
		return "";
	    }else
	    {
		return "Fouth Octect is Wrong";
	    }
	}
    } */
}
// Validates Outside IP
function validateOutsideIP($ip)
{
    $regexp = '/^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/';
    
    if (preg_match($regexp, $ip))
    {
        return "";
    }
    
    return "Outside IP not valid !! <br />";
}

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