<?php
require_once('../model/comment_db.php');
?>

<main>
<?php
        foreach ($allcomments as $comment) :
                //$comment_id = $comment['comment_id'];
                $critique = $comment['critique'];
                //$comment_posted = $comment['comment_posted'];
                //$useful = $comment['useful'];
                //$useless = $comment['useless'];
                //$type = $comment['type'];
                //$review_stars = $comment['review_stars'];
                //$user_commented_id = $comment['user_commented_id'];
                //$comment_on_recipe_id = $comment['comment_on_recipe_id'];
                //$reply_comment_id = $comment['reply_comment_id'];
        ?>

        <div>
                <p><?php echo $critique; ?></p>
        </div>
        <?php endforeach; ?>

</main>