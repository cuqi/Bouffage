<?php
require_once('utils/main.php');
require_once('model/recipe_db.php');
require_once('model/comment_db.php');
require_once('model/search_from_db.php');

$recipe_ids = array();
$recipe_ids = get_all_recipe_ids(); // 1 2 3
$recipes = array(); // prazna lista
$num = 0; // brojac
$search_recipes = array();

if(isset($_POST['search'])){
    $query = $_POST['search'];
    $search_recipes = search($query);
    foreach($search_recipes as $recipe_id){
        $recipe_id = $search_recipes[$num]['recipe_id']; // 1 pa 2
        $recipe = get_recipe($recipe_id);
        $recipes[] = $recipe;
        $num += 1;
    }
}

else {
    foreach ($recipe_ids as $recipe_id) { // za sekoj id od listata na ids
        $recipe_id = $recipe_ids[$num]['recipe_id']; // izminuva ids go zema idto
        $recipe = get_recipe($recipe_id); // spored idto go zema receptot
        $recipes[] = $recipe; // go dodava na recipes listata
        $num +=1;
    }
}
include('home_view.php');
?>
   