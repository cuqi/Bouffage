<?php

function commenting_html($recipeID, $cid, $type)
{

    $html1 =  <<<EOT
    <form action="./comment/add_comment.php" method="POST">
        <input type="hidden" name="recipe_commented" value= "$recipeID" >
        <input class="comment" style="background-color: whitesmoke" type="text" name="commentcritique" placeholder="Leave a $type...">
EOT;

$html2 =  <<<EOT
<input type="hidden" name="commentreplied" value="$cid">
EOT;

$html3 =  <<<EOT
        <div class="dropdown">
            <select class="dropbtn" name="type" >
                <div class="dropdown-content">
                <option value="Comment">Comment</option>
                <option value="Question">Question</option>
                <option value="Tip">Tip</option>
                </div>
            </select>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Go!</button>
        </div>
    </form>
EOT;

if($cid != null)
{
    $html1 = $html1 . $html2;
}

$html = $html1 . $html3;

return $html;
}

function username_and_voting_html($user_id, $id, $path)
{
    if(get_username($user_id) == null)
    {
        $username = "[deleted]";
        $user_id = -1;
    }
    else
    {
        $username = get_username($user_id)['username'];
    }

    $html =  <<<EOT
    <form class="inline" action="./user/index.php" method="GET">
        <input type="hidden" name="open_this_user" value= "$user_id">
        <button class="username" type="submit">$username</button>
    </form>

    <form class="inline" action="./$path/voting.php" method="POST">

        <label id = "arrow">
        <input type="radio" name="vote" id="upvote" value="u%%$user_id%%$id" onclick="submit()">
        <img src="./images/uvote.png" alt="placeholder">
        </label>

        <label id = "arrow">
        <input type="radio" name="vote" id="downvote" value="d%%$user_id%%$id" onclick="submit()">
        <img src="./images/dvote.png" alt="placeholder">
        </label>
    </form>
EOT;

return $html;
}

function delete_this($typeOfPost, $postID)
{
    $is_this_my_post = false;

    if(isset($_SESSION['user']))
    {
        $userme = get_id_from_email($_SESSION['user'])['user_id'];
        if($typeOfPost == "Recipe")
        {
            $recipe = get_recipe($postID);
            $posting_user = $recipe['user_id'];
            if($posting_user == $userme)
            {
                $is_this_my_post = true;
            }
        }
        
        if($typeOfPost == "Comment")
        {
            $comment = get_comment($postID);
            $posting_user = $comment['user_commented_id'];
            if($posting_user == $userme)
            {
                $is_this_my_post = true;
            }
        }
    }

    

    if ((isset($_SESSION['role']) && $_SESSION['role'] == "Admin") || ($is_this_my_post))
    {
        $html =  <<<EOT
        <form action="./helpers/delete.php" class="inline" method="POST">
            <input type="hidden" name="post_deleted" value="$typeOfPost%%$postID">
            <button type="submit" id="delete-button" style="margin-top: 5px;" onclick="return confirm('Are you sure you want to delete this post? ')">Delete</button>
        </form>
    EOT;
    return $html;
    }

}

function make_admin($userID)
{
    $userrole = get_role_from_id($userID)['role'];
    $html = "";

    if ((isset($_SESSION['role']) && $_SESSION['role'] == "Admin") && ($userrole != "Admin"))
    {
        $html =  <<<EOT
        <form action="../helpers/make_user_admin.php" class="inline" method="POST">
            <input type="hidden" name="user_admin" value="$userID">
            <button type="submit" id="admin-button" style="margin-top: 5px;" onclick="return confirm('Are you sure you want to make this user an admin? ')">Make admin</button>
        </form>
    EOT;
    }
    else if ((isset($_SESSION['role']) && $_SESSION['role'] == "Admin") && ($userrole == "Admin"))
    {
        $html =  <<<EOT
        <form action="../helpers/make_user_user.php" class="inline" method="POST">
            <input type="hidden" name="user_user" value="$userID">
            <button type="submit" id="delete-button" style="margin-top: 5px;" onclick="return confirm('Are you sure you want to remove this users status as admin? ')">Remove admin status</button>
        </form>
    EOT;
    }
    return $html;

}
    
function change_image($userID, $picture)
{
    $user_id = get_id_from_email($_SESSION['user'])['user_id'];
    $html = "";

    if ($user_id == $userID)
    {
        $html =  <<<EOT
        <form action="change_picture.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="remove" value="$picture">
            <label for="profile_picture"><b>Change picture: </b></label>            
            <input type="file" name="profile_picture" id="profile_picture">
            <input type="submit" value="Update picture" name="submist">
        </form>
    EOT;
    }
    return $html;
}

?>
