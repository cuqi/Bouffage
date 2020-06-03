<?php
require_once('database.php');

function get_comment($commentID) {
    global $db;
    $query = '
        SELECT *
        FROM comment c
        WHERE comment_id = :commentID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':commentID', $commentID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_critique($commentID) {
    global $db;
    $query = '
        SELECT critique
        FROM comment c
        WHERE comment_id = :commentID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':commentID', $commentID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_comment_by_recipe($commentonrecipeID) {
    global $db;
    $query = '
        SELECT *
        FROM comment c
        WHERE comment_on_recipe_id = :commentonrecipeID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':commentonrecipeID', $commentonrecipeID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_replies_from_comment($replyoncomment) { //replyoncomment the ID from the comment that has replies 
    global $db;
    $query = '
        SELECT *
        FROM comment c
        WHERE reply_comment_id = :replyoncomment
        ORDER BY comment_posted
        ';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':replyoncomment', $replyoncomment);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_all_comments_from_user($commentID)
{
    global $db;
    $query = '
        SELECT comment_id
        FROM comment
        WHERE comment_id = :commentID
    ';
    $statement = $db->prepare($query);
    $statement->bindValue(':commentID', $commentID);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function add_comment($critique, $typeq, $commentinguser, $recipecommented) {
    global $db;
    $query = "INSERT INTO `comment` 
                 (`critique`, `type`, `user_commented_id`, `comment_on_recipe_id`)
              VALUES
                 (:critique, :typeq, :commentinguser, :recipecommented)";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':critique', $critique);
        $statement->bindValue(':typeq', $typeq);
        $statement->bindValue(':commentinguser', $commentinguser);
        $statement->bindValue(':recipecommented', $recipecommented);
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

function add_reply($critique, $typeq, $commentinguser, $recipecommented, $commentreplied) {
    global $db;
    $query = 'INSERT INTO `comment` 
                (`critique`, `type`, `user_commented_id`, `comment_on_recipe_id`, `reply_comment_id`)
              VALUES
                (:critique, :typeq, :commentinguser, :recipecommented, :commentreplied)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':critique', $critique);
        $statement->bindValue(':typeq', $typeq);
        $statement->bindValue(':commentinguser', $commentinguser);
        $statement->bindValue(':recipecommented', $recipecommented);
        $statement->bindValue(':commentreplied', $commentreplied);
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