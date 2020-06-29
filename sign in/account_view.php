<?php include '../view/head.php'; ?>
<?php 
    $email = $_SESSION['user'];
    $my_acc = array();
    $my_acc = get_info_from_email($email);
    $my_username = $my_acc['username'];
    //$my_password = $my_acc['password'];
    $my_karma = $my_acc['karma'];
    $my_verified = $my_acc['verified_email'];
?>
    <h1>My Account</h1>
    <p><b>Username: </b><?php echo $my_username; ?></p>
    <p><b>Karma points: </b><?php echo $my_karma; ?></p>
    <p><b>Email: </b>
            <?php if(isset($my_verified)){ 
                echo $my_verified; 
            } else {
                echo $_SESSION['user'];
                ?>
                <br></br>
                <?php
                echo "Your account is not verified!";
                
            } 
                ?></p>

<?php include '../view/foot.php'; ?>