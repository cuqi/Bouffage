<?php
require_once('../model/recipe_db.php');
require_once('../model/database.php');
require_once('../utils/main.php');

//$recipeID = $_POST['recipeID'];
$cuisine = $_POST['cuisine'];
$description = $_POST['description'];
$user_id = 1;
$recipeID = add_recipe($user_id, $cuisine, $description);

include('../home_view.php');
    
?>