<?php
function get_all_countries() {
    global $db;
    $query = 'SELECT * FROM countries
              ORDER BY countryCode';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $countries = $statement->fetchAll();
        return $countries;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>

