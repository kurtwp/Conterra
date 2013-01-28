
function validate() {
	
	var regName = document.form.regionName;
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
	return validateRegionName(regName);
// End validate function
}