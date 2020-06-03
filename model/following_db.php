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

?>