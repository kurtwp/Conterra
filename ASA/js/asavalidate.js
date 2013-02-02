
	// Validate Region Name
	function validateRegionName(field){
		
		var regexp = /[a-zA-Z]{2}\.[a-zA-Z]{4}\.[a-zA-Z]{7}/;
		
		if (field != "") {
			if 	(field.match(regexp)) {
				return "";
			} else {
				return "Pleae check you Region Name for correct format! \n";
			}
		} else {
			return "Please enter a Region Name! .\n";
		}
	}
	// Validates Outside IP
	function validateOutsideIP(field){
		
		var regexp = /^((1?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(1?\d{1,2}|2[0-4]\d|25[0-5])$/;
		
		if (field != "") {
			if (field.match(regexp)) {
				return "";
			} else {
				return "Please enter a Valid Outside IP address! \n";
			}
		} else {
			return "Please enter a Outside IP address! \n";
		}
	}
	
	function validateInsideNetwork(field){
		
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
					return "Invaild Inside IP \n";
				}
			}
			if (results > 0) {
				return "First Octet needs to start with a 10 \n";
			} else {
				return "";
			}
			
		} else {
			return "Please enter an Inside IP address! \n";
		}
		
	}
	
	function validateInsideMask(field){
		
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
			
		} else {
			return "Pleae enter an Inside Mask \n";
		}
		
	}
	
	function validateMapNumber(field){
		
		var regexp = /^\d+$/;
		
		if (field != "") {
			if (field.match(regexp)) {
				return "";
			
			} else {
				return "Map Number must be all numbers ! \n";
			}
		} else {
			return "Please enter a Map Number ! \n";
		}
	}
	
function validate(form) {

	fail  = validateRegionName(form.regionName.value)
	fail += validateOutsideIP(form.outsideIP.value)
	fail += validateInsideNetwork(form.insideNetwork.value)
	fail += validateInsideMask(form.insideMask.value)
	fail += validateMapNumber(form.mapNumber.value)
	if (fail == "") return true
	else { alert(fail); return false }
	
}
// End validate function
