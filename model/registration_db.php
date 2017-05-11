<?php
function get_all_registrations() {
    global $db;
    $query = 'SELECT * FROM registrations
              ORDER BY customerID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $registrations = $statement->fetchAll();
        return $registrations;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_registration($customer, $code, $date) {
    global $db;
    $query = 'INSERT INTO registrations
                (customerID, productCode, registrationDate)
              VALUES
                (:customer, :code, :date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer', $customer);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':date', $date);
    $statement->execute();
    $statement->closeCursor();
}

function get_registrations_by_customer($customer_id) {
    global $db;
    $query = 'SELECT * FROM registrations r LEFT JOIN tech_products p
              ON r.productCode = p.productCode
              WHERE customerID = :customer_id
              ORDER BY r.productCode';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->execute();
        $registrations = $statement->fetchAll();
        return $registrations;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }   
}
?>
