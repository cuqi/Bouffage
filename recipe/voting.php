<?php
require_once('../model/vote_db.php');
require_once('../model/user_db.php');
require_once('../utils/main.php');

if (isset($_SESSION['user'])) 
{
    $connected_user = $_SESSION['user'];
    $data = $_POST['vote'];
    $data = explode("%%", $data);
    $recipe = $data[2];
    $user = $data[1];
    $userme = get_id_from_email($connected_user)['user_id'];
    $hashevoted = has_user_voted($userme, $recipe );
    if($hashevoted != NULL)
    {
        $hashevoted = $hashevoted['u_or_d'];
    }

    if ($data[0] == "u")
    {
        if($hashevoted == "u")
        {
            recipe_remove_upvote($recipe);
            user_remove_upvote($user);
            user_removed_vote_recipe($userme, $recipe);
        }
        elseif($hashevoted == "d")
        {
            recipe_remove_downvote($recipe);
            user_remove_downvote($user);

            recipe_upvote($recipe);
            user_upvote($user);

            user_updated_vote_recipe($userme, $recipe, $data[0]);
        }
        else
        {
            recipe_upvote($recipe);
            user_upvote($user);
            user_voted_recipe($userme, $recipe, $data[0]);
        }

    }
    else 
    {
        if($hashevoted == "d")
        {
            recipe_remove_downvote($recipe);
            user_remove_downvote($user);
            user_removed_vote_recipe($userme, $recipe);
        }
        elseif($hashevoted == "u")
        {
            recipe_remove_upvote($recipe);
            user_remove_upvote($user);

            recipe_downvote($recipe);
            user_downvote($user);

            user_updated_vote_recipe($userme, $recipe, $data[0]);
        }
        else
        {
            recipe_downvote($recipe);
            user_downvote($user);
            user_voted_recipe($userme, $recipe, $data[0]);
        }
    }

    ?>
    <script>
      window.history.go(-1);
      </script>
    <?php

}
else
{
    header("Location: http://localhost/bouffage/sign%20in/login.php");
}

?>
