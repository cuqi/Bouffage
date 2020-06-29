<?php
require_once('database.php');
require_once('recipe_db.php');
require_once('comment_db.php');


function search($searchquery)
{
    global $db;
    $query = "
        SELECT DISTINCT recipe_id
        from recipe as r, comment as c
        where r.recipe_id = c.comment_on_recipe_id AND 
        (r.title LIKE '%$searchquery%' OR r.essay LIKE '%$searchquery%' OR r.preparation LIKE '%$searchquery%' OR c.critique LIKE '%$searchquery%')
    ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}


?>