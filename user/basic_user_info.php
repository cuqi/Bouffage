<?php
    require_once('../helpers/html_code.php');
    $user = get_user($user_id);
    $username = $user['username'];
    $karma = $user['karma'];
    $date_joined = $user['date_created'];
    $followers = $user['followers'];
    $following = $user['following'];

    if (isset($_SESSION['user']))
    {
        $connected_user = $_SESSION['user'];
        $userme = get_id_from_email($connected_user)['user_id'];
        $following_eachother = already_following($userme, $user_id);
    }
    else
    {
        $following_eachother = false;
        //$userme = -1; //in case there is no logged user set it to sth so it can not create an error in next code
    }

    echo delete_this("User", $user_id);
?>

<img src="//" alt="profile picture for user" style="border-radius: 50%;" style="display: inline-block;">
<h1 ><?php echo $username ?></h1>
<h3>karma: <?php echo $karma ?>  following: <?php echo $following; ?> followers: <?php echo $followers ?> </h3>
<h6>date created: <?php echo $date_joined ?></h6>


<?php if(isset($_SESSION['user']) && $user_id == $userme)
{
?>
         <form action="../helpers/delete.php" class="inline" method="POST">
            <input type="hidden" name="post_deleted" value="User%%<?php echo $user_id; ?>">
            <button type="submit" id="delete-button" onclick="return confirm('Are you sure you want to delete this post? ')">Delete my account</button>
        </form>
        <br>

<?php }
    else if($following_eachother)
    {
?>
    <form action="unfollow.php" method="POST"> 
        <input type="hidden" name="user_followee" value="<?php echo $user_id ?>" >
        <button type="submit">Unollow</button>
     </form>

<?php
    }
    else
    {
?>
    <form action="follow.php" method="POST"> 
        <input type="hidden" name="user_followee" value="<?php echo $user_id ?>" >
        <button type="submit">Follow</button>
     </form>

<?php
    }
?>