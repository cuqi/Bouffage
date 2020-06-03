<?php
require_once('../model/comment_db.php');
require_once('../model/user_db.php');
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


$comment = $_POST['commentcritique'];
$userme = get_id_from_email($connected_user)['user_id'];
$recipe = $_POST['recipe_commented'];
$typeq = $_POST['type'];

if (isset($_POST['commentreplied'])) 
{
    $reply = $_POST['commentreplied'];
    add_reply($comment, $typeq, $userme, $recipe, $reply); 
}
else
{
    add_comment($comment, $typeq, $userme, $recipe);
}

$previous = "javascript:history.back()";
header("Location: $previous");
header("Refresh:0");
?>