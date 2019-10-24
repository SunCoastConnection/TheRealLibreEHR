<?php

require_once ('../globals.php');
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/calendar.inc");

// Save Edit Menu changes
if (!empty($_POST['menuEdits'])) {
    // save a backup copy
    $today = date('Y-m-d');
    //$usermenufile = "../../interface/main/tabs/menu/menu_data.json";
    $usermenufile = "../../sites/default/menu_data.json";
    $usermenubackup = $usermenufile . ".bkup-$today";
    copy($usermenufile, $usermenubackup);
    //Pretty up the output
    $menu_json_pretty =  json_encode(json_decode($_POST['menuEdits']), JSON_PRETTY_PRINT);
    // save the new file
    file_put_contents($usermenufile,$menu_json_pretty);

    echo "$usermenufile and $usermenubackup saved";
    $menu_json_fixed = preg_replace("/\r|\n/", "", $menu_json_pretty);
}


// Save Facility changes

/* Inserting New facility                  */
if (isset($_POST["mode"]) && $_POST["mode"] == "facility" && $_POST["newmode"] != "admin_facility") {
  $insert_id=sqlInsert("INSERT INTO facility SET " .
  "name = '"         . trim(formData('facility'    )) . "', " .
  "alias = '"         . trim(formData('alias'    )) . "', " .
  "phone = '"        . trim(formData('phone'       )) . "', " .
  "fax = '"          . trim(formData('fax'         )) . "', " .
  "street = '"       . trim(formData('street'      )) . "', " .
  "city = '"         . trim(formData('city'        )) . "', " .
  "state = '"        . trim(formData('state'       )) . "', " .
  "postal_code = '"  . trim(formData('postal_code' )) . "', " .
  "country_code = '" . trim(formData('country_code')) . "', " .
  "federal_ein = '"  . trim(formData('federal_ein' )) . "', " .
  "website = '"      . trim(formData('website'     )) . "', " .
  "email = '"        . trim(formData('email'       )) . "', " .
  "color = '"  . trim(formData('ncolor' )) . "', " .
  "service_location = '"  . trim(formData('service_location' )) . "', " .
  "billing_location = '"  . trim(formData('billing_location' )) . "', " .
  "accepts_assignment = '"  . trim(formData('accepts_assignment' )) . "', " .
  "pos_code = '"  . trim(formData('pos_code' )) . "', " .
  "domain_identifier = '"  . trim(formData('domain_identifier' )) . "', " .
  "attn = '"  . trim(formData('attn' )) . "', " .
  "tax_id_type = '"  . trim(formData('tax_id_type' )) . "', " .
  "primary_business_entity = '"  . trim(formData('primary_business_entity' )) . "', ".
  "facility_npi = '" . trim(formData('facility_npi')) . "', ".
  "inactive = '" . trim(formData('inactive')) . "'");

  refreshCalendar(); //after "Add Facility" process is complete
}

/* Editing existing facility                   */
if (trim(formData('inactive')) == 1) {
        $service_location=0;
        $billing_location=0;
} else {
        $service_location=trim(formData('service_location'));
        $billing_location=trim(formData('billing_location'));
}
if ($_POST["mode"] == "facility" && $_POST["newmode"] == "admin_facility")
{
    sqlStatement("update facility set
        name='" . trim(formData('facility')) . "',
        alias = '" . trim(formData('alias')) . "',
        phone='" . trim(formData('phone')) . "',
        fax='" . trim(formData('fax')) . "',
        street='" . trim(formData('street')) . "',
        city='" . trim(formData('city')) . "',
        state='" . trim(formData('state')) . "',
        postal_code='" . trim(formData('postal_code')) . "',
        country_code='" . trim(formData('country_code')) . "',
        federal_ein='" . trim(formData('federal_ein')) . "',
        website='" . trim(formData('website')) . "',
        email='" . trim(formData('email')) . "',
        color='" . trim(formData('ncolor')) . "',
        service_location='" . $service_location . "',
        billing_location='" . $billing_location . "',
        accepts_assignment='" . trim(formData('accepts_assignment')) . "',
        pos_code='" . trim(formData('pos_code')) . "',
        domain_identifier='" . trim(formData('domain_identifier')) . "',
        facility_npi='" . trim(formData('facility_npi')) . "',
        attn='" . trim(formData('attn')) . "' ,
        primary_business_entity='" . trim(formData('primary_business_entity')) . "' ,
        tax_id_type='" . trim(formData('tax_id_type')) . "' ,
        inactive='" . trim(formData('inactive')) . "'

    where id='" . trim(formData('fid')) . "'" );

    refreshCalendar(); //after "Edit Facility" process is complete
}
$form_inactive = empty($_REQUEST['form_inactive']) ? false : true;

echo "<script>window.location.href='../super/edit_settings.php?tab=facilities'</script>";



// Save Users changes


