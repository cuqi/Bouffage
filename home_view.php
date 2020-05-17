<main class="nofloat">
    <h1>Recipes</h1>
        <p>We offer free and tasty recipes for your cooking enjoyment. 
        From exotic foods to mouth watering desserts, 
        we are sure you`ll find something to test your culinary skills. Enjoy!
        </p>
        <div>
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
            ?>
                <?php echo $recipeID; ?>
                <?php echo $cuisine; ?>
                <?php echo $preparation; ?>
                <?php echo $essay; ?>
                <?php echo $prep_time; ?>
                <?php echo $cook_time; ?>
                <?php echo $servings; ?>
                <?php echo $complexity; ?>
                <?php echo $upvotes; ?>
                <?php echo $downvotes; ?>
                <?php echo $posting_date; ?>
                <?php echo $special_equipment; ?>
                <?php echo $user_id; ?>
            <?php endforeach; ?>
        </div>
</main>