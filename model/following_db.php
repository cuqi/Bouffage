<?php
require_once('database.php');

function follow($user1, $user2)
{
    global $db;
    $query = '
    INSERT INTO following (user_following_id, user_followee_id)
    VALUES (:user1, :user2)
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user1', $user1);
    $statement->bindValue(':user2', $user2);
    $statement->execute();
    $statement->closeCursor();
}

function unfollow($user1, $user2)
{
    global $db;
    $query = '
        DELETE FROM following 
        WHERE user_following_id = :user1 AND user_followee_id =:user2
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user1', $user1);
    $statement->bindValue(':user2', $user2);
    $statement->execute();
    $statement->closeCursor();
}

function increase_followers($user) {
    global $db;
    $query = '
        UPDATE `user`
        SET `followers` = `followers` + 1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function decrease_followers($user) {
    global $db;
    $query = '
        UPDATE `user`
        SET `followers` = `followers` - 1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function increase_following($user) {
    global $db;
    $query = '
        UPDATE `user`
        SET `following` = `following` + 1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function decrease_following($user) {
    global $db;
    $query = '
        UPDATE `user`
        SET `following` = `following` - 1 
        WHERE user_id = :user
        ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
}

function already_following($user1, $user2)
{
    global $db;
    $query = '
        SELECT *
        FROM following
        WHERE user_following_id = :user1 AND user_followee_id = :user2
    ';
    try
    {
        $db->prepare($query);
        $statement = $db->prepare($query);
        $statement->bindValue(':user1', $user1);
        $statement->bindValue(':user2', $user2);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    }
    catch (PDOException $e) {
        $error_message = $e->getMessage();
    }
}

?>