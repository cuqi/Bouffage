<?php include 'view/header.php'; ?>
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

                </div>
            </div>
                
                <?php echo $posting_date; ?>
                <?php echo $special_equipment; ?>
                <?php echo $user_id; ?>
            <div id = "separator"></div>
            <?php endforeach; ?>
</main>
<?php include 'view/footer.php'; ?>