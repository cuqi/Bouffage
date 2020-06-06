<?php
require_once('../model/vote_db.php');
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



$data = $_POST['vote'];
$data = explode("%%", $data);
$comment = $data[2];
$user = $data[1];
$userme = get_id_from_email($connected_user)['user_id'];
$hashevoted = has_user_voted_comment($userme, $comment);
if($hashevoted != NULL)
{
    $hashevoted = $hashevoted['u_or_d'];
}

if ($data[0] == "u")
{
    if($hashevoted == "u")
    {
        comment_remove_upvote($comment);
        user_remove_upvote($user);
        user_removed_vote_comment($userme, $comment);
    }
    elseif($hashevoted == "d")
    {
        comment_remove_downvote($comment);
        user_remove_downvote($user);

        comment_upvote($comment);
        user_upvote($user);

        user_updated_vote_comment($userme, $comment, $data[0]);
    }
    else
    {
        comment_upvote($comment);
        user_upvote($user);
        user_voted_comment($userme, $comment, $data[0]);
    }

}
else 
{
    if($hashevoted == "d")
    {
        comment_remove_downvote($comment);
        user_remove_downvote($user);
        user_removed_vote_comment($userme, $comment);
    }
    elseif($hashevoted == "u")
    {
        comment_remove_upvote($comment);
        user_remove_upvote($user);

        comment_downvote($comment);
        user_downvote($user);

        user_updated_vote_comment($userme, $comment, $data[0]);
    }
    else
    {
        comment_downvote($comment);
        user_downvote($user);
        user_voted_comment($userme, $comment, $data[0]);
    }
}

$previous = "javascrip:history.back()";
header("Location: $previous");

?>
