<?php include 'view/header.php'; ?>
<?php
require_once('utils/main.php');
require_once('model/recipe_db.php');

// Set the featured product IDs in an array
$recipe_ids = array(1);
// Note: You could also store a list of featured products in the database

// Get an array of featured products from the database
$recipes = array();
foreach ($recipe_ids as $recipe_id) {
    $recipe = get_recipes($recipe_id);
    $recipes[] = $recipe;
}
get_all();

include('home_view.php');
?>
<?php include 'view/footer.php'; ?>
   