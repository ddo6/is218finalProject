<?php
function get_all_unassigned_incidents() {
    global $db;
    $query = 'SELECT * 
              FROM incidents i 
              JOIN customers c ON i.customerID = c.customerID
              JOIN products p ON i.productCode = p.productCode
              WHERE techID IS NULL
              ORDER BY dateOpened';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchAll();
        return $incidents;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}


function get_all_assigned_incidents()
{
    global $db;
    $query = 'SELECT * FROM incidents
				INNER JOIN customers
		    			ON incidents.customerID = customers.customerID
				INNER JOIN products
						ON incidents.productCode = products.productCode
			  WHERE incidents.techID IS NOT NULL';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
/*function get_all_assigned_incidents() {
    global $db;
    $query = 'SELECT c.firstName AS cFirstName, c.lastName AS cLastName,
                     t.firstName AS tFirstName, t.lastName AS tLastName,
                     p.name AS productName, 
                     i.incidentID AS id,
                     i.dateOpened AS open, i.dateClosed AS closed, 
                     i.title AS title, i.description AS description
              FROM incidents i 
              JOIN customers c ON i.customerID = c.customerID
              JOIN products p ON i.productCode = p.productCode
              JOIN technicians t ON i.techID = t.techID
              WHERE i.techID IS NOT NULL
              ORDER BY dateOpened';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchAll();
        return $incidents;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}*/

function get_incident_by_id($id) {
    global $db;
    $query = 'SELECT * FROM incidents i LEFT JOIN customers c
              ON i.customerID = c.customerID WHERE incidentID = :id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $incident = $statement->fetch();
        $statement->closeCursor();
        return $incident;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_assigned_incidents($id) {
    global $db;
    $query = 'SELECT * FROM incidents i LEFT JOIN customers c
              ON i.customerID = c.customerID WHERE (techID = :id) AND (dateClosed IS NULL)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $incidents = $statement->fetchAll();
        return $incidents;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function count_assigned_incidents_by_technicians() {
    global $db;
    $query = 'SELECT t.techID, t.firstName, t.lastName, 
                COALESCE(i.openIncidents, 0) AS openIncidents FROM
             (SELECT * FROM technicians) t
              LEFT JOIN
             (SELECT techID, COUNT(*) AS openIncidents 
                FROM incidents 
                WHERE dateClosed IS NULL 
                GROUP BY techID) i
              ON t.techID = i.techID
              ORDER BY i.openIncidents';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchAll();
        return $technicians;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_incident($customer_id, $product, $date, $title, $description) {
    global $db;
    $query = 'INSERT INTO incidents
                 (customerID, productCode, dateOpened, title, description)
              VALUES
                 (:customer_id, :product, :date, :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product', $product);
    $statement->bindValue(':date', $date);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

function assign_incident($incident_id, $tech_id) {
    global $db;
    $query = 'UPDATE incidents
              SET techID = :tech_id
              WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->bindValue(':tech_id', $tech_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_incident_description($incident_id, $description) {
    global $db;
    $query = 'UPDATE incidents
              SET description = :description
              WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

function update_incident($incident_id, $date, $description) {
    global $db;
    $query = 'UPDATE incidents
              SET dateClosed = :date, description = :description
              WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->bindValue(':date', $date);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}
?>
