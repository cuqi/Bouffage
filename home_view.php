<?php 
include 'view/header.php'; 
include 'view/sidebar.php';

//require_once('model/comment_db.php');
require_once('model/user_db.php');?>
<main class="nofloat">
        <p>We offer free and tasty recipes for your cooking enjoyment. 
        From exotic foods to mouth watering desserts, 
        we are sure you`ll find something to test your culinary skills. Enjoy!
        </p>
        <br></br>
            <?php foreach ($recipes as $recipe) :
                $recipeID = $recipe['recipe_id'];
                $cuisine = $recipe['cuisine'];
                $essay = $recipe['essay'];
                $preparation = $recipe['preparation'];
                $prep_time = $recipe['prep_time'];
                $cook_time = $recipe['cook_time'];
                $servings = $recipe['servings'];
                $complexity = $recipe['complexity'];
                $upvotes = $recipe['upvotes'];
                $downvotes = $recipe['downvotes'];
                $posting_date = $recipe['posting_date'];
                $special_equipment = $recipe['special_equipment'];
                $user_id = $recipe['user_id'];

                $comp = "";
                switch($complexity) {
                    case 'Easy':
                        $comp = "complex_easy";
                        break;
                    case 'Medium':
                        $comp = "complex_medium";
                        break;
                    case 'Hard':
                        $comp = "complex_hard";
                        break;
                    default:
                        $comp = " ";
                }

                $aggregate = $upvotes - $downvotes;
            ?>
            <div>
                <img id="myimg" class="myimg" src="images/<?php echo htmlspecialchars($recipeID); ?>.jpg" alt="&nbsp;">
                <div>
                <form action="./user/index.php" method="POST">
                <input type="hidden" name="listtheserecpes" value= "<?php echo $user_id?>">
                 <button type="submit"><?php echo get_username($user_id)['username'] ?></button>
                </form>               
                </div>
                <div>
                    <form action="./recipe/voting.php" method="POST">
                        <label>
                        <input type="radio" name="vote" id="upvote" value="u%%<?php echo $user_id?>%%<?php echo $recipeID?>" onclick="submit()">
                        <img src="./images/uvote.png" alt="placeholder">
                        </label>

                        <label>
                        <input type="radio" name="vote" id="downvote" value="<d%%?php echo $user_id?>%%<?php echo $recipeID?>" onclick="submit()">
                        <img src="./images/dvote.png" alt="placeholder">
                        </label>

                    </form>
                </div>
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
            <form action="./recipe/index.php" method="POST">
                <input type="hidden" name="listthecomments" value= "<?php echo $recipeID?>">
                 <button type="submit"><?php echo "yes"; ?></button>
            </form>
            </div>
            <div>
                <?php $name = filter_input(INPUT_POST, 'name'); ?>   
            </div>
            <div id = "separator"></div>
            <?php endforeach; ?>
</main>
<?php include 'view/footer.php'; ?>