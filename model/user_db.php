<?php
require_once('database.php');

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

function get_username($userID) {
    global $db;
    $query = '
        SELECT username
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

function get_username_from_email($email) {
    global $db;
    $query = '
        SELECT username
        FROM user u
        WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_info_from_email($email) {
    global $db;
    $query = '
        SELECT username, password, karma, verified_email
        FROM user u
        WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_id_from_email($email) {
    global $db;
    $query = '
        SELECT user_id
        FROM user u
        WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
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

function is_valid_user($entered_email, $entered_password) {
    global $db;
    $password = sha1($entered_email . $entered_password);
    $query = '
        SELECT email, password
        FROM user
        WHERE email = :entered_email AND password = :password
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':entered_email', $entered_email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function is_valid_email($entered_email) {
    global $db;
    $query = '
        SELECT email
        FROM user
        WHERE email = :entered_email
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':entered_email', $entered_email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function add_user_to_db($email, $password, $username, $profile_picture) {
    global $db;
    $password = sha1($email . $password);
    $query = '
        INSERT INTO user (email, password, username, profile_picture)
        VALUES (:email, :password, :username, :profile_picture)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':profile_picture', $profile_picture);
    $statement->execute();
    $customer_id = $db->lastInsertId();
    $statement->closeCursor();
    return $customer_id;
}

function get_role($entered_email) {
    global $db;
    $query = '
        SELECT `role`
        FROM `user`
        WHERE `email` = :entered_email
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':entered_email', $entered_email);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function get_role_from_id($entered_id) {
    global $db;
    $query = '
        SELECT `role`
        FROM `user`
        WHERE `user_id` = :entered_id
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':entered_id', $entered_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function delete_user($userID)
{
    global $db;
    $query = '
        DELETE FROM user 
        WHERE user_id = :user
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $userID);
    $statement->execute();
    $statement->closeCursor();
}

function does_user_exist($searchedID) {
    global $db;
    $query = '
        SELECT *
        FROM user
        WHERE user_id = :searchedID
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':searchedID', $searchedID);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function make_this_user_admin($user_to_be_adminID) {
    global $db;
    $query = '
        UPDATE `user`
        SET `role` = :admin 
        WHERE `user_id` = :user_to_be_adminID
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':admin', "Admin");
    $statement->bindValue(':user_to_be_adminID', $user_to_be_adminID);
    $statement->execute();
    $statement->closeCursor();
}

function make_this_user_user($user_to_be_adminID) {
    global $db;
    $query = '
        UPDATE `user`
        SET `role` = :user 
        WHERE `user_id` = :user_to_be_adminID
    ';
    $db->prepare($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':user', "User");
    $statement->bindValue(':user_to_be_adminID', $user_to_be_adminID);
    $statement->execute();
    $statement->closeCursor();
}

function change_picture($profile_picture, $user_id)
{
    global $db;
    $query = "
            UPDATE user 
            SET profile_picture= :profile_picture
            WHERE user_id = :user_id
    ";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':profile_picture', $profile_picture);
    $statement->execute();
    $statement->closeCursor();
}

?>