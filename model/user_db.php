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

function get_all_credentials() {
    global $db;
    $query = '
        SELECT username, password
        FROM user
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
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