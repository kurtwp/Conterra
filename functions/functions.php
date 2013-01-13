<?php
//Validates Inside Masks
function validateInsideMask($mask)
{
    $tempArray = explode(".",$mask);
    $tempArrayCount = count($tempArray);
    If ($tempArrayCount < 4) {
        return "Invalid Mask";
    } else {
        for ($i=0; $i<3; $i++)
        {
            if ($tempArray[$i] != 255)
            {
                return "The Fist 3 octets need to be 255";
            }
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
    }
    
    return "Outside IP not valid !!\n";
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

// Validate Region Name
function validate_regionName($field) {
    	if ($field == "") return "No Region Name was entered<br />";
	return "";
}


?>