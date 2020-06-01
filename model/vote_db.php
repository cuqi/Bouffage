<?php
require_once('database.php');

function recipe_upvote($recipe) {
    global $db;
    $query = '
        UPDATE recipe
        SET upvotes = upvotes+1 
        WHERE recipe_id = :recipe
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe', $recipe);
    $statement->execute();
}

function recipe_remove_upvote($recipe) {
    global $db;
    $query = '
        UPDATE recipe
        SET upvotes = upvotes-1 
        WHERE recipe_id = :recipe
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe', $recipe);
    $statement->execute();
}

function recipe_downvote($recipe) {
    global $db;
    $query = '
        UPDATE recipe
        SET downvotes = downvotes+1 
        WHERE recipe_id = :recipe
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe', $recipe);
    $statement->execute();
}

function recipe_remove_downvote($recipe) {
    global $db;
    $query = '
        UPDATE recipe
        SET downvotes = downvotes-1 
        WHERE recipe_id = :recipe
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe', $recipe);
    $statement->execute();
}

function user_upvote($user) {
    global $db;
    $query = '
        UPDATE user
        SET karma = karma+1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function user_remove_upvote($user) {
    global $db;
    $query = '
        UPDATE user
        SET karma = karma-1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function user_downvote($user) {
    global $db;
    $query = '
        UPDATE user
        SET karma = karma-1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function user_remove_downvote($user) {
    global $db;
    $query = '
        UPDATE user
        SET karma = karma+1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function has_user_voted($user, $recipe)
{
    global $db;
    $query = '
        SELECT u_or_d
        FROM vote_recipe
        WHERE user_voted_this_recipe_id = :user AND recipe_got_voted_id = :recipe
    ';
    try
    {
        $db->prepare($query);
        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->bindValue(':recipe', $recipe);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $error_message = $e->getMessage();
    }
}

function user_voted_recipe($user, $recipe, $castvote)
{
    global $db;
    $query = '
    INSERT INTO vote_recipe (user_voted_this_recipe_id, recipe_got_voted_id, u_or_d)
    VALUES (:user, :recipe, :castvote)
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':recipe', $recipe);
    $statement->bindValue(':castvote', $castvote);
    $statement->execute();
    $statement->closeCursor();
}

function user_removed_vote_recipe($user, $recipe)
{
    global $db;
    $query = '
        DELETE FROM vote_recipe 
        WHERE user_voted_this_recipe_id = :user AND recipe_got_voted_id =:recipe
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':recipe', $recipe);
    $statement->execute();
    $statement->closeCursor();
}

function user_updated_vote_recipe($user, $recipe, $castvote)
{
    global $db;
    $query = '
        UPDATE vote_recipe
        SET u_or_d = :castvote 
        WHERE user_voted_this_recipe_id = :user AND recipe_got_voted_id = :recipe
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':recipe', $recipe);
    $statement->bindValue(':castvote', $castvote);
    $statement->execute();
    $statement->closeCursor();
}


?>