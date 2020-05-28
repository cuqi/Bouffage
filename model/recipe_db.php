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

function add_recipe($recipe_id, $cuisine, $essay, $preparation,
        $prep_time, $cook_time, $servings, $upvotes, $downvotes, $posting_date, $special_equipment, $user_id) {
    global $db;
    $query = 'INSERT INTO recipe
                 (recipe_id, cuisine, essay, preparation, prep_time,
                  cook_time, servings, upvotes, downvotes, posting_date, special_equipment, user_id)
              VALUES
                 (:recipe_id, :cuisine, :essay, :preparation, :prep_time,
                  :cook_time, :servings, :upvotes, :downvotes, :posting_date, :special_equipment, :user_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':recipe_id', $recipe_id);
        $statement->bindValue(':cuisine', $cuisine);
        $statement->bindValue(':essay', $essay);
        $statement->bindValue(':preparation', $preparation);
        $statement->bindValue(':prep_time', $prep_time);
        $statement->bindValue(':cook_time', $cook_time);
        $statement->bindValue(':servings', $servings);
        $statement->bindValue(':upvotes', $upvotes);
        $statement->bindValue(':downvotes', $downvotes);
        $statement->bindValue(':posting_date', $posting_date);
        $statement->bindValue(':special_equipment', $special_equipment);
        $statement->bindValue(':user_id', $user_id);

        $statement->execute();
        $statement->closeCursor();

        // Get the last recipe ID that was automatically generated
        $recipe_id = $db->lastInsertId();
        return $recipe_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_one($recipe_id, $essay, $user_id) {
    global $db;
    $query = 'INSERT INTO recipe
                 (recipe_id, essay, user_id)
              VALUES
                 (:recipe_id, :essay, :user_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':essay', $essay);
        $statement->bindValue(':recipe_id', $recipe_id);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();

        // Get the last recipe ID that was automatically generated
        $recipe_id = $db->lastInsertId();
        return $recipe_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>