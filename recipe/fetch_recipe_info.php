<?php
    $recipeID = $recipe['recipe_id'];
    $cuisine = $recipe['cuisine'];
    $essay = $recipe['essay'];
    $preparation = $recipe['preparation'];
    $prep_time = $recipe['prep_time'];
    $cook_time = $recipe['cook_time'];              //getting the basic information from the array/database
    $servings = $recipe['servings'];
    $complexity = $recipe['complexity'];
    $upvotes = $recipe['upvotes'];
    $downvotes = $recipe['downvotes'];
    $posting_date = $recipe['posting_date'];
    $special_equipment = $recipe['special_equipment'];
    $user_id = $recipe['user_id'];
    $title = $recipe['title'];

    $comp = "";
    switch($complexity) {
        case 'Easy':
            $comp = "complex_easy";
            break;
        case 'Medium':
            $comp = "complex_medium";
            break;                          //setting the color of the text according to the complexity
        case 'Hard':
            $comp = "complex_hard";
            break;
        default:
            $comp = " ";
    }

    $aggregate = $upvotes - $downvotes;

    $comments = get_comment_by_recipe($recipeID);
?>