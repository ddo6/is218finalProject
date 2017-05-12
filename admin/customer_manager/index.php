<?php
require_once('../../util/main.php');
require_once('../../util/secure_conn.php');
require('../../model/database.php');
require('../../model/customer_db.php');
require('../../model/country_db.php');

require_once('../../model/fields.php');
require_once('../../model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('fname');
$fields->addField('lname');
$fields->addField('address');
$fields->addField('city');
$fields->addField('state', 'Use 2 character abbreviation.');
$fields->addField('zip');
$fields->addField('phone', 'Use (999) 999-9999 format.');
$fields->addField('email', 'Must be a valid email address.');
$fields->addField('password', 'Must be at least 6 characters.');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_customers';
    }
}

// customers
switch($action) {
    case 'list_customers':
        // list all customers
        $customers = get_all_customers();
        include('customer_list.php');
        break;
    case 'search_customer':
        // search customers
        $lname = filter_input(INPUT_POST, 'lname');
        if ($lname == NULL || $lname == FALSE) {
            $error = "Missing or incorrect last name.";
            include('../../errors/error.php');
        } else { 
            $customers = search_customer($lname);
            include('customer_list.php');
        }   
        break;
   
}
?>
