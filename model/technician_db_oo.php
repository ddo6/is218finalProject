<?php
class TechnicianDB {
    public static function get_all_technicians() {
        $db = Database::getDB();
        $query = 'SELECT * FROM technicians
                  ORDER BY techID';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $technicians = $statement->fetchAll();
            return $technicians;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::display_db_error($error_message);
        }
    }

    public static function get_technician($id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM technicians
                  WHERE techID = :id';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $technician = $statement->fetch();
            $statement->closeCursor();
            return $technician;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::display_db_error($error_message);
        }
    }

    public static function delete_technician($id) {
        $db = Database::getDB();
        $query = 'DELETE FROM technicians
                  WHERE techID = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function add_technician($id, $fname, $lname, $email, $phone, $password) {
        $db = Database::getDB();
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
}

