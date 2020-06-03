<?php
require_once('../model/comment_db.php');
require_once('../model/database.php');

    $comments = $_POST['listthecomments'];
    $comments_ids = array();
    $comments_ids = get_all_comments_from_user($comments);
    $allcomments = array();
    $num = 0;
    foreach ($comments_ids as $comment_id) {
        $comment_id = $comments_ids[$num]['comment_id'];
        $singlecomment = get_critique($comment_id);
        $allcomments[] = $singlecomment;
        $num +=1;
    }
    include('comments.php');
?>