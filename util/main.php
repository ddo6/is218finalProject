<?php
// Get the document root
$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);

// Get the application path
$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
$dirs = explode('/', $uri);
$app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/' . $dirs[3] . '/';

// Set the include path
set_include_path($doc_root . $app_path);

// Function for non-database errors
function display_error($error_message) {
    global $app_path;
    include 'errors/error.php';
    exit;
}

// Start session
session_start();