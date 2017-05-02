<?php
require_once('../util/main.php');
require_once('../util/secure_conn.php');
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        if (isset($_SESSION['user'])) {
            $action = 'returning_customer';
        } else {
            $action = 'view_login';
        }
    }
}

switch($action) {
    case 'view_login':
        // Clear login data
        $email = '';
        $pasword = '';
        
        include 'customer_login.php';
        break;
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (!empty($email) && !empty($password) && is_valid_customer_login($email, $password)) {
            $_SESSION['user'] = get_customer_by_email($email);
            $customer_name = $_SESSION['user']['firstName'] . ' ' .
                             $_SESSION['user']['lastName'];
            $products = get_all_products();
            include 'product_register.php';
        } else {
            $error_message = 'Login failed. Missing or invalid email/password.';
            $password = '';
            include 'customer_login.php';
        }
        break;
    case 'returning_customer':
        $email = $_SESSION['user']['email'];
        $password = $_SESSION['user']['password'];
        if (!empty($email) && !empty($password) && is_valid_customer_login($email, $password)) {
            $_SESSION['user'] = get_customer_by_email($email);
            $customer_name = $_SESSION['user']['firstName'] . ' ' .
                             $_SESSION['user']['lastName'];
            $products = get_all_products();
            include 'product_register.php';
        } else {
            $error_message = 'Login failed. Missing or invalid email/password.';
            $password = '';
            include 'customer_login.php';
        }
        break;
    case 'register_product':
        $customer = $_SESSION['user']['customerID'];
        $code = filter_input(INPUT_POST, 'code');
        $date = date('Y-m-d');
        add_registration($customer, $code, $date);
        include 'registration_confirmation.php';
        break;
    case 'logout':
        // End session
        $_SESSION = array();
        session_destroy();
        
        // Delete cookie from browser
        $name = session_name();
        $expire = strtotime('-1 year');
        $params = session_get_cookie_params();
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        
        // Reset email and password and return to main menu
        $email = '';
        $password  = '';
        header("Location: ". $app_path);
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}

?>