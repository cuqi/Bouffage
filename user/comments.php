<?php
require_once('../model/comment_db.php');
require_once('../model/database.php');

    $comments = $_POST['listthecomments'];
    $comments_ids = array();
    $comments_ids = get_all_comments_from_user($comments);
    
    $allcomments = array();
    $num = 0;
    foreach ($comment_ids as $comment_id) {
        $comment_id = $comments_ids[$num]['comment_id'];
        $allcomments = get_critique($comment_id);
        $allcomentslist[] = $allcomments;
        $num +=1;
    }
    include('recipe_list.php');
?>