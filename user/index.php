<?php
require_once('../model/recipe_db.php');
require_once('../model/database.php');
require_once('../utils/main.php');

$dumbrecipessaywhat = $_POST['listtheserecpes'];
$recipe_ids = array();
$recipe_ids = get_all_recipes_from_user($dumbrecipessaywhat);
$recipes = array();
$num = 0;
foreach ($recipe_ids as $recipe_id) {
    $recipe_id = $recipe_ids[$num]['recipe_id'];
    $recipe = get_recipe($recipe_id);
    $recipes[] = $recipe;
    $num += 1;
}
include('recipe_list.php');
?>