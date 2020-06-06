<?php include '../view/head.php'; ?>

<main class="nofloat">
    <h1 class="top">Listing recipes</h1>
    <p>To add your recipe, click</p>
    <?php if (count($recipes) == 0) : ?>
        <p>There are no recipes for this category.</p>
    <?php else : ?>
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
                <img id="myimg" class="myimg" src="../images/<?php echo htmlspecialchars($recipeID); ?>.jpg" alt="&nbsp;">
                <div id="textbox">
                    <?php echo $essay; ?> <br></br>
                    <?php echo $preparation; ?> <br></br>
                    <?php echo $special_equipment; ?>
                </div>
                <div>
                    <p>Type of cuisine: <?php echo $cuisine; ?></p>
                    <p>Preparation time: <?php echo $prep_time; ?> minutes.</p>
                    <p>Cooking time: <?php echo $cook_time; ?> minutes.</p>
                    <p>Number of servings: <?php echo $servings; ?></p>
                    <p id = "<?php echo $comp?>">Difficulty level: <?php echo $complexity; ?></p>
                    <p>Rating: <?php echo $aggregate; ?></p>
                    <p id = "small-text"> Posted on: <?php echo $posting_date; ?></p>
                </div>
            </div>
            <div id = "separator"></div>
            <?php endforeach; ?>
    <?php endif; ?>
</main>
<?php include '../view/foot.php'; ?>