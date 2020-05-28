<?php
require_once('../model/recipe_db.php');
require_once('../model/database.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'add_recipe';
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

    case 'add_recipe':
        $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_VALIDATE_INT);
        $cuisine = filter_input(INPUT_POST, 'cuisine');
        $essay = filter_input(INPUT_POST, 'essay');
        $preparation = filter_input(INPUT_POST, 'preparation');
        $prep_time = filter_input(INPUT_POST, 'prep_time', FILTER_VALIDATE_INT);
        $cook_time = filter_input(INPUT_POST, 'cook_time', FILTER_VALIDATE_INT);
        $servings = filter_input(INPUT_POST, 'servings', FILTER_VALIDATE_INT);
        $upvotes = filter_input(INPUT_POST, 'upvotes', FILTER_VALIDATE_INT);
        $downvotes = filter_input(INPUT_POST, 'downvotes', FILTER_VALIDATE_INT);
        $posting_date = filter_input(INPUT_POST, 'posting_date');
        $special_equipment = filter_input(INPUT_POST, 'special_equipment');
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

        // Validate inputs
        // if (empty($code) || empty($name) || empty($description) ||
        //     $price === false || $discount_percent === false) {
        //     $error = 'Invalid product data.
        //               Check all fields and try again.';
        //     include('../../errors/error.php');
        // } else {
        $product_id = add_recipe($recipe_id, $cuisine, $essay, $preparation,
        $prep_time, $cook_time, $servings, $upvotes, $downvotes, $posting_date, $special_equipment, $user_id);
        include('recipe_add.php');
        break;
        
}
?>