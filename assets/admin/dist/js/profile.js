function validate()
{
    if (func.ValidateId(["username", "fname" , "lname" ,"male","setting_password","setting_cpassword"], ["email"], ["phone"]) === true) {
        return true
    }
    return false;
}
