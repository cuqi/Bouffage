<?php
require_once('database.php');
// GET RECIPES - INDEX - SEGA ZA SEGA SAMO ID 1
function get_recipe($recipeID) {
    global $db;
    $query = '
        SELECT *
        FROM recipe r
        WHERE recipe_id = :recipeID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':recipeID', $recipeID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_all_recipes() {
    global $db;
    $query = '
        SELECT COUNT(recipe_id)
        FROM recipe
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function get_all_recipe_ids()
{
    global $db;
    $query = '
        SELECT recipe_id
        FROM recipe
    ';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function get_all_recipes_from_user($userID)
{
    global $db;
    $query = '
        SELECT recipe_id
        FROM recipe
        WHERE user_id = :userID
    ';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}


// function add_recipe($user_id, $code, $name, $description,
//         $price, $discount_percent) {
//     global $db;
//     $query = 'INSERT INTO recipe
//                  (recipe_id, essay, user_id)
//               VALUES
//                  (:recipe_id, :essay, :user_id)';
//     try {
//         $statement = $db->prepare($query);
//         $statement->bindValue(':essay', $essay);
//         $statement->bindValue(':recipe_id', $recipe_id);
//         $statement->bindValue(':user_id', $user_id);
//         $statement->execute();
//         $statement->closeCursor();

//         // Get the last recipe ID that was automatically generated
//         $recipe_id = $db->lastInsertId();
//         return $recipe_id;
//     } catch (PDOException $e) {
//         $error_message = $e->getMessage();
//         display_db_error($error_message);
//     }
// }

?>