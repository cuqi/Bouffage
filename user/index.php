<?php
require_once('../model/recipe_db.php');
require_once('../model/database.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_recipes';
    }
}

switch($action) {
    case 'list_recipes':
        $recipe_ids = array(1,2);
        $recipes = array();
        foreach ($recipe_ids as $recipe_id) {
            $recipe = get_recipe($recipe_id);
            $recipes[] = $recipe;
        }
        include('recipe_list.php');
        break;

    case 'view_recipe':
        $recipeID = filter_input(INPUT_GET, 'recipe_id', FILTER_VALIDATE_INT);
        $recipe = get_recipes($recipeID);
        $product_order_count = get_product_order_count($product_id);
        include('product_view.php');
        break;
}
?>