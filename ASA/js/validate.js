
function validate() {
	
	var regName = document.form.regionName;
	var mapNumb = document.form.mapNumber;
	
	//return validateRegionName(regName);

	function validateRegionName(regName) {
		var reg_len = regName.value.length;
		if (reg_len != 0) {
			return true;
		} else {
			alert("Enter Region name");
			return false;
		}
	}
	
	function validateMapNumber(mapNumb) {
		var map_len = mapNumb.value.length;
		if (map_len != 0) {
			return true;
		} else {
			alert("Enter VLAN number");
			return false;
		}
	}
	
	return validateMapNumber(mapNumb);
	return validateRegionName(regName);
	
// End validate function
}