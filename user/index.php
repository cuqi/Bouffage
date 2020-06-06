<?php
require_once('../model/recipe_db.php');
require_once('../model/database.php');
require_once('../model/user_db.php');
require_once('../model/following_db.php');
require_once('../utils/main.php');

$user_id = $_GET['open_this_user'];
$recipe_ids = array();
$recipe_ids = get_all_recipes_from_user($user_id);
$recipes = array();
$num = 0;
foreach ($recipe_ids as $recipe_id) {
$recipe_id = $recipe_ids[$num]['recipe_id'];
$recipe = get_recipe($recipe_id);
$recipes[] = $recipe;
$num +=1;
}

include('basic_user_info.php');
include('recipe_list.php');
?>