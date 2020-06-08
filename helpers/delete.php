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

$data = $_POST['post_deleted'];
$data = explode("%%", $data);
$typeOfPost = $data[0];
$postID = $data[1];

if($typeOfPost == "Comment")
{
    delete_comment($postID);
    header("Refresh: 0");
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    header("Location: $previous");
}
else 
{
    if($typeOfPost == "Recipe")
    {
        delete_recipe($postID);
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        header("Location: $previous");
    }
    else 
    {
        if($typeOfPost == "User")
        {
            delete_user($postID);
            header("Refresh: 0"); //tuka ako stoi istiot kod kje ima prob koa kje go vrakja na url so ne postoi
        }
        else
        {
            header("Location: https://youtu.be/dQw4w9WgXcQ");
        }
    }
}

?>
