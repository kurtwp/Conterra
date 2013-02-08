
	// Validate Host Name
	function validateHostName(field){
		
		var regexp = /[a-zA-Z]{2}\.[a-zA-Z]{4}\.[a-zA-Z]{7}\.[nN][dD]\d{2}/;
		
		if (field != "") {
			if 	(field.match(regexp)) {
				return "";
			} else {
				return "Pleae check your Host Name for correct format! \n";
			}
		} else {
			return "Please enter a Host Name! .\n";
		}
	}
	// Validate Gateway IP
	function validateGatewayIP(field){
		
		if (field != "") {
			var regexp = /^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/;
			var tempIP = field.split(",");
			var arrayCnt = tempIP.length;
			var results = 0;
			for (var i=0;i<arrayCnt;i++) {
				var firstOct = tempIP[i].split(".");
				if (tempIP[i].match(regexp)) {
					if (firstOct[0] != 10) {
						results += 1;
					}
				} else {
					return "Invaild Gateway IP \n";
				}
			}
			if (results > 0) {
				return "First Octet needs to start with a 10 \n";
			} else {
				return "";
			}
			
		} else {
			return "Please enter a Gateway IP address! \n";
		}
		
	}
	// Validate Management IP
	function validateManagementIP(field){
		
		if (field != "") {
			var regexp = /^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/;
			var tempIP = field.split(",");
			var arrayCnt = tempIP.length;
			var results = 0;
			for (var i=0;i<arrayCnt;i++) {
				var firstOct = tempIP[i].split(".");
				if (tempIP[i].match(regexp)) {
					if (firstOct[0] != 10) {
						results += 1;
					}
				} else {
					return "Invaild Management IP \n";
				}
			}
			if (results > 0) {
				return "First Octet needs to start with a 10 \n";
			} else {
				return "";
			}
			
		} else {
			return "Please enter a Management IP address! \n";
		}
		
	}
	//Validate Management Mask
	function validateManagementMask(field){
		
		var octect = [0,128,192,224,240,248,252,254,255];
		
		if (field != "") {
			var tmpArray = field.split(".");
			var arrayCnt = tmpArray.length;
			if (arrayCnt < 4 || arrayCnt > 4) {
				return "Invalid Subnet Mask \n";
			}
			if (arrayCnt == 4) {
				for (i=0;i<3;i++) {
					if (tmpArray[i] != 255 || tmpArray [3] == "") {
						return "The First 3 octect need to start with 255 \n";
					}
				}
			}
			if (arrayCnt == 4) {
				for (k=0;k<10;k++) {
					if (octect[k] == tmpArray[3]) {
						return "";
					}
				}
				if (k == 10) {
					return "Fouth octect is invalid \n";
				}
			}
		} else {
			return "Pleae enter a Management Mask \n";
		}
		
	}
	// Validate Circuit ID
	function validateCircuitID(field){
		
		var regexp = /[cC][tT][sS]\d{5}/;
		
		if (field != "") {
			if (field.match(regexp)) {
				return "";
			
			} else {
				return "Please check the Circuit ID ! \n";
			}
		} else {
			return "Please enter a Circuit ID ! \n";
		}
	}
	// Validate NTP Server IP
	function validateNTPIP(field) {
		var regexp = /^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/;
		if (field != "") {
			if (field.match(regexp)) {
				var tmpArray = field.split(".");
				if (tmpArray[0] != 10) {
					return "First Octet needs to start with 10!\n";
				} else {
					return "";
				}
			} else {
				return "Invalid IP address\n";
			}	
		} else {
			return "Please enter in an the NTP Server IP which should be the IP of the MetroNID!\n";
		}
	}
	
function ethervalidate(form) {
	
	fail  = validateHostName(form.hostName.value)
	fail += validateGatewayIP(form.gateIP.value)
	fail += validateManagementIP(form.manaIP.value)
	fail += validateManagementMask(form.manaMask.value)
	fail += validateCircuitID(form.circID.value)
	fail += validateNTPIP(form.ntpIP.value) 
	if (fail == "") return true
	else { alert(fail); return false }
	
}
// End validate function
