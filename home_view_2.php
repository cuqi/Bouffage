<?php 
include 'view/header.php'; 
include 'view/sidebar.php';

require_once('model/comment_db.php');
require_once('model/user_db.php');?>
<main class="nofloat">
        <p>We offer free and tasty recipes for your cooking enjoyment. 
        From exotic foods to mouth watering desserts, 
        we are sure you`ll find something to test your culinary skills. Enjoy!
                       </p>
        <br></br>
            <?php foreach ($recipes as $recipe) :

                include('./recipe/fetch_recipe_info.php');

            ?>

        <div id = "separator"></div> 
        <br>
        <div>  
            <div>

                <form class="inline" action="./user/index.php" method="GET">
                <input type="hidden" name="open_this_user" value= "<?php echo $user_id?>">
                <button class="username" type="submit"><?php echo get_username($user_id)['username'] ?></button>
                </form>  
                
                <form class="inline" action="./recipe/voting.php" method="POST">

                <label id = "arrow">
                    <input type="radio" name="vote" id="upvote" value="u%%<?php echo $user_id?>%%<?php echo $recipeID?>" onclick="submit()">
                    <img src="./images/uvote.png" alt="placeholder">
                    </label>

                    <label id = "arrow">
                    <input type="radio" name="vote" id="downvote" value="d%%<?php echo $user_id?>%%<?php echo $recipeID?>" onclick="submit()">
                    <img src="./images/dvote.png" alt="placeholder">
                    </label>
                </form>
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
                    <form class="inline" action="./user/index.php" method="GET">
                    <input type="hidden" name="open_this_user" value= "<?php echo $cuser?>">
                    <button class="username" type="submit"><?php echo get_username($cuser)['username'] ?></button>
                    </form>

                    <form class="inline" action="./comment/voting.php" method="POST">
                        <label id = "arrow">
                        <input type="radio" name="vote" id="upvote" value="u%%<?php echo $user_id?>%%<?php echo $cid?>" onclick="submit()">
                        <img src="./images/uvote.png" alt="placeholder">
                        </label>

                        <label id = "arrow">
                        <input type="radio" name="vote" id="downvote" value="d%%<?php echo $user_id?>%%<?php echo $cid?>" onclick="submit()">
                        <img src="./images/dvote.png" alt="placeholder">
                        </label>
                     </form>


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
                                <form class="inline" action="./user/index.php" method="GET">
                                <input type="hidden" name="open_this_user" value= "<?php echo $ruser?>">
                                <button class="username" type="submit"><?php echo get_username($ruser)['username'] ?></button>
                            </form>

                            <form class="inline" action="./comment/voting.php" method="POST">
                                <label id = "arrow">
                                <input type="radio" name="vote" id="upvote" value="u%%<?php echo $user_id?>%%<?php echo $rid?>" onclick="submit()">
                                <img src="./images/uvote.png" alt="placeholder">
                                </label>

                                <label id = "arrow">
                                <input type="radio" name="vote" id="downvote" value="d%%<?php echo $user_id?>%%<?php echo $rid?>" onclick="submit()">
                                <img src="./images/dvote.png" alt="placeholder">
                                </label>
                            </form>

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
                            <form action="./comment/add_comment.php" method="POST">
                                <input type="hidden" name="recipe_commented" value= "<?php echo $recipeID ?>" >
                                <input class="comment" style="background-color: whitesmoke" type="text" name="commentcritique" placeholder="Leave a reply...">
                                <input type="hidden" name="commentreplied" value="<?php echo $cid ?>">
                                <div class="dropdown">
                                    <select class="dropbtn" name="type" >
                                        <div class="dropdown-content">
                                        <option value="Comment">Comment</option>
                                        <option value="Question">Question</option>
                                        <option value="Tip">Tip</option>
                                        </div>
                                    </select>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn">Go!</button>
                                </div>
                             </form>


                    </div>
                    <?php endforeach; ?>

                            <!-- include 'add_comment.php' i ggwp -->
            <form action="./comment/add_comment.php" method="POST">
                <input type="hidden" name="recipe_commented" value= "<?php echo $recipeID ?>" >
                <input class="comment" style="background-color: whitesmoke" type="text" name="commentcritique" placeholder="Leave a comment...">
                <div class="dropdown">
                    <select class="dropbtn" name="type" >
                        <div class="dropdown-content">
                        <option value="Comment">Comment</option>
                        <option value="Question">Question</option>
                        <option value="Tip">Tip</option>
                        </div>
                    </select>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Go!</button>
                </div>
            </form>
            </div>
            <div>
                <?php $name = filter_input(INPUT_POST, 'name'); ?>   
            </div>
            <?php endforeach; ?>
</main>
<?php include 'view/footer.php'; ?>