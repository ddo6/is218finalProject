<?php
//Add the required model components for use
require_once('../../util/main.php');
require_once('../../util/secure_conn.php');
require('../../model/database.php');
require('../../model/customer_db.php');
require('../../model/country_db.php');

require_once('../../model/fields.php');
require_once('../../model/validate.php');

//Initialize the validate object to be used for form validation
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
        
     case 'show_add_edit_form':
        // call page to add or edit customer information
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $customer = get_customer($id);
        $countries = get_all_countries();
        $fname = $customer['firstName'];
        $lname = $customer['lastName'];
        $address = $customer['address'];
        $city = $customer['city'];
        $state = $customer['state'];
        $country = $customer['countryCode'];
        $zip = $customer['postalCode'];
        $phone = $customer['phone'];
        $email = $customer['email'];
        $password = $customer['password'];
        include('customer_add_edit.php');
        break;
        
        
   case 'add_customer':
        // create new customer
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $customer = get_customer($id);
        $countries = get_all_countries();
        $fname = trim(filter_input(INPUT_POST, 'fname'));
        $lname = trim(filter_input(INPUT_POST, 'lname'));
        $address = trim(filter_input(INPUT_POST, 'address'));
        $city = trim(filter_input(INPUT_POST, 'city'));
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $country = filter_input(INPUT_POST, 'country');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = trim(filter_input(INPUT_POST, 'email'));
        $password = filter_input(INPUT_POST, 'password');
        
   // Set the params for the validate functions based on the user input entered
        $validate->text('fname', $fname);
        $validate->text('lname', $lname);
        $validate->text('address', $address);
        $validate->text('city', $city);
        $validate->state('state', $state);
        $validate->zip('zip', $zip);
        $validate->phone('phone', $phone);
        $validate->email('email', $email);
        $validate->password('password', $password);
        
    // Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            include('customer_add_edit.php');
        } else {
            add_customer($id, $fname, $lname, $address, $city, $state, $zip, $country, $phone, $email, $password);
            header("Location: .");
        }
        break;  
        
    //Update customer information by collection data and posting them to database  
    case 'update_customer':
        // update customer information
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $customer = get_customer($id);
        $countries = get_all_countries();
        $fname = trim(filter_input(INPUT_POST, 'fname'));
        $lname = trim(filter_input(INPUT_POST, 'lname'));
        $address = trim(filter_input(INPUT_POST, 'address'));
        $city = trim(filter_input(INPUT_POST, 'city'));
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $country = filter_input(INPUT_POST, 'country');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = trim(filter_input(INPUT_POST, 'email'));
        $password = filter_input(INPUT_POST, 'password');
        
     // validate form data
        $validate->text('fname', $fname);
        $validate->text('lname', $lname);
        $validate->text('address', $address);
        $validate->text('city', $city);
        $validate->state('state', $state);
        $validate->zip('zip', $zip);
        $validate->phone('phone', $phone);
        $validate->email('email', $email);
        $validate->password('password', $password);
        
        // Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            include('customer_add_edit.php');
        } else {
            update_customer($id, $fname, $lname, $address, $city, $state, $zip, $country, $phone, $email, $password);
            header("Location: .");
        }
        break;  
        
        //Default 
    default:
        display_error("Unknown action: " . $action);
        break;
}
?>
