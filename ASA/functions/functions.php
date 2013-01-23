<?php

// Validate VlAN
function validateVLAN($vlan) {
    
    // Reg Ex checks for postive numbers only
    $regexp = '/^\d+$/';
    
    if ($vlan != "") {
        if (preg_match($regexp, $vlan))
        {
            return "";
        } else {
            return "VLAN ID must be all numbers !";
        }
    } else {
        return "Please enter a VLAN Number !<br />";
    }
}
// Validate Region Name
function validate_regionName($name) {
    
    $regexp = '/[a-zA-Z][a-zA-Z]\.[a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z]\.[a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z]/';
    
    if ($name != "") {
        if (preg_match($regexp, $name)) {
            return "";
        } else {
            return "Pleae check you region name for correct format <br />";
        }
    } else {
        return "Please enter a Region Name !<br />";
    }
}
//Validates Inside Masks
function validateInsideMask($mask) {
    
    $octect = array(0,128,192,224,240,248,252,254,255);

    if ($mask != "") {
        $tempArray = explode(".",$mask);
        $tempArrayCount = count($tempArray);
        If ($tempArrayCount < 4 || $tempArrayCount > 4)
        {
            return "Invalid Mask <br />";
        }
        if ($tempArrayCount == 4)
        {
            for ($i=0; $i<3; $i++)
            {
                if ($tempArray[$i] != 255 || $tempArray[3] == "")
                {
                    return "The Fist 3 octets need to be 255 <br />";
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
                return "Fouth octect is invalid <br />";
            }
        }
    } else {
        return "Please enter an Inside Mask !<br />";
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
    if ($ip != "") {
        $regexp = '/^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/';
        $tempIP = explode(",",$ip);
        $arrayCount = count($tempIP);
        $results = 0;
        for ($i=0; $i<$arrayCount; $i++) {
            $firstOctect = explode(".",$tempIP[$i]);
            if (preg_match($regexp, $tempIP[$i])) {
                if ($firstOctect[0] != 10) {
                    $results += 1;
                    echo $results;
                } 
            } else {
                return "Invalid IP <br />";
            }
        }
        if ($results > 0) {
            return "First Octect needs to start with 10 <br />";
        } else {
            return "";
        }
    } else {
        return "Please enter an Inside IP address ! <br />";
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