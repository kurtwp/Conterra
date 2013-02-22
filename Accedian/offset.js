
// Calculate History Offset
    function hstyOffset () {
		var result = 0;
        var nidIP = document.getElementById('myInput').value;
        var tempIP = nidIP.split(".");
		validateManagementIP(nidIP);
        result = ((parseInt(tempIP[2]) + parseInt(tempIP[3])) % 4)
        document.getElementById('myOutput').innerHTML = result;
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
                    alert("Invalid Mangement IP");
					return exit;
				}
			}
			if (results > 0) {
                alert("First Octet needs to start with a 10 \n");
				return exit;
			} else {
				return "";
			}
			
		} else {
            alert("Please enter a Management IP address! \n");
			return exit;
		}
        return "";	
	}

