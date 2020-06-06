<?php
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
?>


<img src="//" alt="profile picture for user" style="border-radius: 50%;" style="display: inline-block;">
<h1 ><?php echo $username ?></h1>
<h3>karma: <?php echo $karma ?>  following: <?php echo $following; ?> followers: <?php echo $followers ?> </h3>
<h6>date created: <?php echo $date_joined ?></h6>


<?php if($following_eachother)
{
?>
    <form action="unfollow.php" method="POST"> 
        <input type="hidden" name="user_followee" value="<?php echo $user_id ?>" >
        <button type="submit">Unollow</button>
     </form>

<?php }
    else if(isset($_SESSION['user']) && $user_id == $userme)
    {
?>
    <h4>Well silly you are the one that is connected haha</h4>

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