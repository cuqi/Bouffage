<?php
function add_image($image_name, $image_from_recipe) {
    global $db;
    $query = "
            INSERT INTO recipe_image (image_name, image_from_recipe)
            VALUES (:image_name, :image_from_recipe)
    ";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':image_name', $image_name);
        $statement->bindValue(':image_from_recipe', $image_from_recipe);
        $statement->execute();
        $statement->closeCursor();

        // Get the last recipe ID that was automatically generated
        $recipe_image_id = $db->lastInsertId();
        return $recipe_image_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>