
<ul>
    <li>
        <a href="http://localhost/bouffage/user/recipe_add.php"> Add Recipes </a>
    </li>
    <?php
            // Check if user is logged in and
            // display appropriate account links
            $account_url = $app_path . 'sign in';
            $login_url = 'sign in/login.php';

            $logout_url = $account_url . '?sign%20in=logout';
            echo $login_url;
            echo session_id();
            if (isset($_SESSION['user'])) :
            ?>
            <li><a href="<?php echo $account_url; ?>">My Account</a></li>
            <li><a href="<?php echo $logout_url; ?>">Logout</a>
            <?php else: ?>
                <li><a href="<?php echo $login_url; ?>">Login</a></li>
            <?php endif; ?>
        <li>
            <a href="<?php echo $app_path; ?>">Home</a>
        </li>
</ul>


