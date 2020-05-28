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

function recipe_upvotevote($recipe) {
    global $db;
    $query = '
        UPDATE recipe
        SET upvotes = upvotes+1, downvotes = downvotes-1
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

function recipe_downvotevote($recipe) {
    global $db;
    $query = '
        UPDATE recipe
        SET upvotes = upvotes-1, downvotes = downvotes+1
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


?>