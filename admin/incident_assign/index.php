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
        include('unassigned_incident_list.php');
        break;
    case 'show_select_technician':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $_SESSION['incident'] = get_incident_by_id($id);
        $technicians = count_assigned_incidents_by_technicians();
        include('select_technician.php');
        break;
    case 'select_technician':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $_SESSION['technician'] = get_technician($id);
        $technician_name = $_SESSION['technician']['firstName'] . ' ' .
                           $_SESSION['technician']['lastName'];
        $customer_name = $_SESSION['incident']['firstName'] . ' ' .
                         $_SESSION['incident']['lastName'];
        $product = $_SESSION['incident']['productCode'];
        include('assign_incident.php');
        break;
    case 'assign_technician':
        $incident_id = $_SESSION['incident']['incidentID'];
        $tech_id = $_SESSION['technician']['techID'];
        try {
            assign_incident($incident_id, $tech_id);
            include('assignment_confirmation.php');
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            display_error($error_message);
        }
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}


