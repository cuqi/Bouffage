<?php
require_once('../model/vote_db.php');

function bothUpvote($user, $recipe)
{
    user_upvote($user);
    recipe_upvote($recipe);
}

function bothDownvote($user, $recipe)
{
    user_downvote($user);
    recipe_downvote($recipe);
} 

if (isset($_SESSION['user'])) 
{
    $connected_user = $_SESSION['user'];
    echo "inside session";
}
else
{
    header("Location: http://localhost/bouffage/sign%20in/login.php");
}




$data = $_POST['vote'];
$data = explode("%%", $data);
if ($data[0] == "u")
{
    bothUpvote($data[1], $data[2]);
}
else 
{
    bothDownvote($data[1], $data[2]);
}



?>
