function validate()
{
    if (func.ValidateId(["company_name", "service_charge_value" , "company_name" ,"vat_charge_value","address","country","currency"], [], ["phone"]) === true) {
        return true
    }
    return false;
}