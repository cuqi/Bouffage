<?php
require_once('database.php');
// GET RECIPES - INDEX - SEGA ZA SEGA SAMO ID 1
function get_user($userID) {
    global $db;
    $query = '
        SELECT *
        FROM user u
        WHERE user_id = :userID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_username($userID) {
    global $db;
    $query = '
        SELECT username
        FROM user u
        WHERE user_id = :userID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_username_from_email($email) {
    global $db;
    $query = '
        SELECT username
        FROM user u
        WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_id_from_email($email) {
    global $db;
    $query = '
        SELECT user_id
        FROM user u
        WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_all_users() {
    global $db;
    $query = '
        SELECT *
        FROM user
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function is_valid_user($entered_email, $entered_password) {
    global $db;
    $password = sha1($entered_email . $entered_password);
    $query = '
        SELECT email, password
        FROM user
        WHERE email = :entered_email AND password = :password
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':entered_email', $entered_email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function is_valid_email($entered_email) {
    global $db;
    $query = '
        SELECT email
        FROM user
        WHERE email = :entered_email
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':entered_email', $entered_email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function add_user_to_db($email, $password, $username) {
    global $db;
    $password = sha1($email . $password);
    $query = '
        INSERT INTO user (email, password, username)
        VALUES (:email, :password, :username)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $customer_id = $db->lastInsertId();
    $statement->closeCursor();
    return $customer_id;
}


// function add_recipe($user_id, $code, $name, $description,
//         $price, $discount_percent) {
//     global $db;
//     $query = 'INSERT INTO products
//                  (categoryID, productCode, productName, description, listPrice,
//                   discountPercent, dateAdded)
//               VALUES
//                  (:category_id, :code, :name, :description, :price,
//                   :discount_percent, NOW())';
//     try {
//         $statement = $db->prepare($query);
//         $statement->bindValue(':category_id', $category_id);
//         $statement->bindValue(':code', $code);
//         $statement->bindValue(':name', $name);
//         $statement->bindValue(':description', $description);
//         $statement->bindValue(':price', $price);
//         $statement->bindValue(':discount_percent', $discount_percent);
//         $statement->execute();
//         $statement->closeCursor();

//         // Get the last product ID that was automatically generated
//         $product_id = $db->lastInsertId();
//         return $product_id;
//     } catch (PDOException $e) {
//         $error_message = $e->getMessage();
//         display_db_error($error_message);
//     }
// }

?>