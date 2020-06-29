<?php 
include 'view/header.php'; 
//include 'view/sidebar.php';

require_once('model/comment_db.php');
require_once('./helpers/html_code.php');
require_once('model/user_db.php');?>
<main class="nofloat">
        <!-- <p>We offer free and tasty recipes for your cooking enjoyment. 
        From exotic foods to mouth watering desserts, 
        we are sure you`ll find something to test your culinary skills. Enjoy!
                       </p> -->
            <?php foreach ($recipes as $recipe) :

                include('./recipe/fetch_recipe_info.php');

            ?>
        
        <br>
        <div>  
            <div>
                
                <?php echo username_and_voting_html($user_id, $recipeID, "recipe"); ?>
                
                <?php echo delete_this("Recipe", $recipeID); ?>

            <br>

            <p class="title"> <?php echo $title; ?></p>

            </div>

            <br>
            <img id="myimg" class="myimg" src="images/<?php echo htmlspecialchars($recipeID); ?>.jpg" alt="&nbsp;">
            
            <div id="textbox">
                <?php echo $essay; ?> <br></br>
                <?php echo $preparation; ?>
            </div>
        
            <div>
                <p>Type of cuisine: <?php echo $cuisine; ?></p>
                <p>Preparation time: <?php echo $prep_time; ?> minutes.</p>
                <p>Cooking time: <?php echo $cook_time; ?> minutes.</p>
                <p>Number of servings: <?php echo $servings; ?></p>
                <p id = "<?php echo $comp?>">Difficulty level: <?php echo $complexity; ?></p>
                <p>Rating: <?php echo $aggregate; ?></p>
                <p>Posted on: <?php echo $posting_date; ?></p>
                <p>Special equipment: <?php echo $special_equipment; ?></p>
            </div>

        </div>
            <div>
                <?php foreach ($comments as $comment):
                    if(isset($comment['reply_comment_id']))
                    {
                        continue;
                    }

                    $cid = $comment['comment_id'];
                    $cuser = $comment['user_commented_id'];
                    $cuseful = $comment['useful'];
                    $cuseless = $comment['useless'];
                    $ctime = $comment['comment_posted'];
                    $ccritique = $comment['critique'];
                    $creplyto = $comment['reply_comment_id'];
                    $replies = get_replies_from_comment($comment['comment_id']);

                    ?>

                    <div id="textbox" class="comment">

                    <?php echo username_and_voting_html($cuser, $cid, "comment"); ?>
                    <?php echo delete_this("Comment", $cid); ?>

                    <br>
                    usefull :<?php echo $cuseful; ?>       useless: <?php echo $cuseless; ?>
                    <br>
                        <?php echo $ccritique; ?> 
                        <br>
                        <?php echo $ctime; ?>

                        <!-- Reference for where the recipe is on the page -->
                        <a href="<?php echo $recipeID?>"></a>

                        <?php foreach ($replies as $reply):
                            $rid = $reply['comment_id'];
                            $ruser = $reply['user_commented_id'];
                            $ruseful = $reply['useful'];
                            $ruseless = $reply['useless'];
                            $rtime = $reply['comment_posted'];
                            $rcritique = $reply['critique'];
                            ?>
                            <div class="reply">

                            <?php echo username_and_voting_html($ruser, $rid, "comment"); ?>
                            <?php echo delete_this("Comment", $rid); ?>

                            <br>
                            usefull :<?php echo $ruseful; ?>       useless: <?php echo $ruseless; ?>
                            <br>
                            <?php echo $rcritique; ?> 
                            <br>
                            <?php echo $rtime; ?>
                            </div>
                            <br>
                            
                        <?php endforeach; ?>

                        <!-- Code for a section to reply -->
                        <?php echo commenting_html($recipeID, $cid, "reply" ); ?>
                            </form>


                    </div>
                    <?php endforeach; ?>

                            <!-- Code for section to comment -->
                            <?php echo commenting_html($recipeID, null, "comment"); ?>
            </div>
            <div id = "separator"></div> 
            <?php endforeach; ?>
</main>
<?php include 'view/footer.php'; ?>