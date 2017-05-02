<?php
function get_all_technicians() {
    global $db;
    $query = 'SELECT * FROM technicians
              ORDER BY techID';
    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statement->fetchAll();
    return $technicians;
}

function get_technician($id) {
    global $db;
    $query = 'SELECT * FROM technicians
              WHERE techID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $technician = $statement->fetch();
    $statement->closeCursor();
    return $technician;
}

function get_technician_by_email($email) {
    global $db;
    $query = 'SELECT * FROM technicians WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $technician = $statement->fetch();
        $statement->closeCursor();
        return $technician;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_technician($id) {
    global $db;
    $query = 'DELETE FROM technicians
              WHERE techID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}

function add_technician($id, $fname, $lname, $email, $phone, $password) {
    global $db;
    $query = 'INSERT INTO technicians
                 (techID, firstName, lastName, email, phone, password)
              VALUES
                 (:id, :fname, :lname, :email, :phone, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':lname', $lname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_tech_login($email, $password) {
    global $db;
    $query = 'SELECT * FROM technicians
              WHERE email = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}
?>