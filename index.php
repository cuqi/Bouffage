<?php
require_once('utils/main.php');
require_once('model/recipe_db.php');

// Set the featured product IDs in an array
$recipe_ids = array(1,2,4);
// Note: You could also store a list of featured products in the database
// Get an array of featured products from the database
$recipes = array();
foreach ($recipe_ids as $recipe_id) {
    $recipe = get_recipe($recipe_id);
    $recipes[] = $recipe;
}
//$recipe_id = add_recipe(4, "yes", "yeye", "tete", 10, 10, 12, 10, 4, "12.12.2012", "yes", 1);
include('home_view.php');
?>
   