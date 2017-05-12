<?php
require_once('../../util/main.php');
require_once('../../util/secure_conn.php');
require('../../model/database.php');
require('../../model/customer_db.php');
require('../../model/product_db.php');
require('../../model/registration_db.php');
require('../../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'search_form';
    }
}

//Options for form processesing
switch($action) {
        
    case 'search_form':
        include 'customer_search.php';
        break;
    case 'search_customers':
        $email = filter_input(INPUT_POST, 'email');
        if ($email == NULL || $email == FALSE) {
            $error = "Missing or incorrect email.";
            include '../../errors/error.php';
        } else { 
            $customer = get_customer_by_email($email);
            $customer_id = $customer['customerID'];
            $registrations = get_registrations_by_customer($customer_id);
            if ($registrations == NULL || $registrations == FALSE) {
                $error = "Customer has no registered products.";
                include '../../errors/error.php';
            } else {
                include 'incident_add.php';
            }
        }
        break;
    case 'create_incident':
        $customer_id = filter_input(INPUT_POST, 'customer_id');
        $product = filter_input(INPUT_POST, 'product');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        
        $date = date('Y-m-d');
        
        add_incident($customer_id, $product, $date, $title, $description);
        include 'incident_confirmation.php';
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}

?>
