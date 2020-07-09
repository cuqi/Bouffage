<?php  
      require_once('../model/comment_db.php');  
?>


<main class="nofloat">
<div id = "separator"></div>
<br>
    <?php if (count($recipes) == 0) : ?>
        <p>This user has no recipes posted.</p>
    <?php else : ?>
            <?php foreach ($recipes as $recipe) : 
                include '../recipe/fetch_recipe_info.php';
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
            <?php endforeach; ?>
    <?php endif; ?>
</main>
<?php include '../view/foot.php'; ?>