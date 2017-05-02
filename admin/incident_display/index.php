<?php
require_once('../../util/main.php');
require_once('../../util/secure_conn.php');
require('../../model/database.php');
require('../../model/incident_db.php');
require('../../model/customer_db.php');
require('../../model/technician.php');
require('../../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_unassigned_incidents';
    }
}

switch($action) {
    case 'list_unassigned_incidents':
        $incidents = get_all_unassigned_incidents();
        include('unassigned_incidents.php');
        break;
    case 'list_assigned_incidents':
        $incidents = get_all_assigned_incidents();
        include('assigned_incidents.php');
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}