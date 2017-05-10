<?php
require_once('../util/main.php');
require_once('../util/secure_conn.php');
require('../model/database.php');
require('../model/admin_db.php');
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        if (isset($_SESSION['admin'])) {
            $action = 'returning_admin';
        } else {
            $action = 'view_login';
        }
    }
}
switch($action) {
    case 'view_login':
        // Clear login data
        $username = '';
        $password = '';
        
        include 'admin_login.php';
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (!empty($username) && !empty($password) && is_valid_admin_login($username, $password)) {
            $_SESSION['admin'] = get_admin_by_username($username);
            $username = $_SESSION['admin']['username'];
            include 'admin_menu.php';
        } else {
            $error_message = 'Login failed. Missing or invalid username/password.';
            $password = '';
            include 'admin_login.php';
        }
        break;
    case 'returning_admin':
        $username = $_SESSION['admin']['username'];
        $password = $_SESSION['admin']['password'];
        if (!empty($username) && !empty($password) && is_valid_admin_login($username, $password)) {
            $_SESSION['admin'] = get_admin_by_username($username);
            $username = $_SESSION['admin']['username'];
            include 'admin_menu.php';
        } else {
            $error_message = 'Login failed. Missing or invalid username/password.';
            $password = '';
            include 'admin_login.php';
        }
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
        
        // Reset username and password and return to main menu
        $username = '';
        $password = '';
        header("Location: ". $app_path);
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}
