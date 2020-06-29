<?php
require_once('../model/comment_db.php');
require_once('../model/user_db.php');
require_once('../model/recipe_db.php');
require_once('../utils/main.php');

if (isset($_SESSION['user'])) 
{
    $connected_user = $_SESSION['user'];
    echo "inside session";
}
else
{
    header("Location: http://localhost/bouffage/sign%20in/login.php");
}

$user = $_POST['user_admin'];


?>