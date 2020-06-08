<?php
require_once('../model/following_db.php');
require_once('../model/user_db.php');
require_once('../utils/main.php');

if (isset($_SESSION['user'])) 
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

follow($userme, $user_id);
increase_followers($user_id);
increase_following($userme);

$previous = "javascript:history.back()";
header("Location: $previous");

?>