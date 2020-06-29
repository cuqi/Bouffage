<?php
require_once('utils/main.php');
require_once('model/recipe_db.php');
require_once('model/comment_db.php');

$test = $app_path . 'test';

$recipe_ids = array();
$recipe_ids = get_all_recipe_ids();
$recipes = array();
$num = 0;
foreach ($recipe_ids as $recipe_id) {
    $recipe_id = $recipe_ids[$num]['recipe_id'];
    $recipe = get_recipe($recipe_id);
    $recipes[] = $recipe;
    $num +=1;
}

include('home_view.php');
?>
   