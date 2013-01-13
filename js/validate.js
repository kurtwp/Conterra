function validate(form)
{
	fail  = validateRegionname(form.regionName.value)
        if (fail == "") return true
	else { alert(fail); return false }
}