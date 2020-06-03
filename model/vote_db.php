<?php
require_once('database.php');

//functions to regulate voting in recipes
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


//functions to regulate voting in comments
function comment_upvote($comment) {
    global $db;
    $query = '
        UPDATE comment
        SET useful = useful+1 
        WHERE comment_id = :comment
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
}

function comment_remove_upvote($comment) {
    global $db;
    $query = '
        UPDATE comment
        SET useful = useful-1 
        WHERE comment_id = :comment
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
}

function comment_downvote($comment) {
    global $db;
    $query = '
        UPDATE comment
        SET useless = useless+1 
        WHERE comment_id = :comment
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
}

function comment_remove_downvote($comment) {
    global $db;
    $query = '
        UPDATE comment
        SET useless = useless-1 
        WHERE comment_id = :comment
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':comment', $comment);
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


//for voting recipes
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


//for voting comments
function has_user_voted_comment($user, $comment)
{
    global $db;
    $query = '
        SELECT u_or_d
        FROM vote_comment
        WHERE user_voted_this_comment = :user AND comment_got_voted_id = :comment
    ';
    try
    {
        $db->prepare($query);
        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->bindValue(':comment', $comment);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $error_message = $e->getMessage();
    }
}

function user_voted_comment($user, $comment, $castvote)
{
    global $db;
    $query = '
    INSERT INTO vote_comment (user_voted_this_comment, comment_got_voted_id, u_or_d)
    VALUES (:user, :comment, :castvote)
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':comment', $comment);
    $statement->bindValue(':castvote', $castvote);
    $statement->execute();
    $statement->closeCursor();
}

function user_removed_vote_comment($user, $comment)
{
    global $db;
    $query = '
        DELETE FROM vote_comment 
        WHERE user_voted_this_comment = :user AND comment_got_voted_id =:comment
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
    $statement->closeCursor();
}

function user_updated_vote_comment($user, $comment, $castvote)
{
    global $db;
    $query = '
        UPDATE vote_comment
        SET u_or_d = :castvote 
        WHERE user_voted_this_comment = :user AND comment_got_voted_id = :comment
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':comment', $comment);
    $statement->bindValue(':castvote', $castvote);
    $statement->execute();
    $statement->closeCursor();
}


?>