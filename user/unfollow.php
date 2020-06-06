<?php
require_once('../model/following_db.php');
require_once('../model/user_db.php');
require_once('../utils/main.php');

if (isset($_SESSION['user']))       //Since its in unfollow the user is connected but just in case
{
    $connected_user = $_SESSION['user'];
    echo "inside session";
    $userme = get_id_from_email($connected_user)['user_id'];
}
else
{
    header("Location: http://localhost/bouffage/sign%20in/login.php");
}

$user_id = $_POST['user_followee'];

unfollow($userme, $user_id);
decrease_followers($user_id);
decrease_following($userme);

$previous = "javascrip:history.back()";
header("Location: $previous");

?>