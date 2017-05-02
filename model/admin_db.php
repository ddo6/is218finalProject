<?php
function get_admin_by_username($username) {
    global $db;
    $query = 'SELECT * FROM administrators WHERE username = :username';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        return $admin;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function is_valid_admin_login($username, $password) {
    global $db;
    $query = '
        SELECT * FROM administrators
        WHERE username = :username AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}