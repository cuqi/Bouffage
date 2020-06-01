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

            $toindex = $app_path . 'sign in';
            echo $login_url;
            
            
            if (isset($_SESSION['user'])) :
            ?>
            <li>
                <form action="./sign in/index.php" method="POST">
                    <input type="hidden" name="whatdo" value= "my_account">
                    <button type="submit">My Account</button>
                </form>
            </li>
            <?php else: ?>
                <li>
                <form action="./sign in/index.php" method="POST">
                    <input type="hidden" name="whatdo" value= "login">
                    <button type="submit">Login</button>
                </form>

                </li>
            <?php endif; ?>
        <li>
            <a href="<?php echo $app_path; ?>">Home</a>
        </li>
</ul>


