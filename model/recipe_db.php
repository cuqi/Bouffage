<?php
require_once('database.php');

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

function get_cuisine()
{
    global $db;
    $query = '
        SELECT cuisine
        FROM recipe
    ';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function get_cuisine_enum()
{
    global $db;
    $query = "
        SELECT column_type FROM information_schema.columns 
        WHERE table_name = 'recipe' AND column_name = 'cuisine';
    ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    $result = str_replace(array("set('", "')", "''"), array('', '', "'"), $result);
    $result = implode("", $result);
    $arr = explode("','", $result);
    return $arr;
}

function get_complexity_enum()
{
    global $db;
    $query = "
        SELECT column_type FROM information_schema.columns 
        WHERE table_name = 'recipe' AND column_name = 'complexity';
    ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    $result = str_replace(array("set('", "')", "''"), array('', '', "'"), $result);
    $result = implode("", $result);
    $arr = explode("','", $result);
    return $arr;
}

function add_recipe($title, $cuisine, $essay, $preparation, $prep_time, $cook_time, $servings, $complexity, $special_equipment, $user_id) {
    global $db;
    $query = 'INSERT INTO recipe 
                (title, cuisine, essay, preparation, prep_time, cook_time, servings, complexity, special_equipment, user_id)
              VALUES
                 (:title, :cuisine, :essay, :preparation, :prep_time, :cook_time, :servings, :complexity, :special_equipment, :user_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':cuisine', $cuisine);
        $statement->bindValue(':essay', $essay);
        $statement->bindValue(':preparation', $preparation);
        $statement->bindValue(':prep_time', $prep_time);
        $statement->bindValue(':cook_time', $cook_time);
        $statement->bindValue(':servings', $servings);
        $statement->bindValue(':complexity', $complexity);
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

?>