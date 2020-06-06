<?php

function voting_html($user_id, $id, $path)
{
    $username = get_username($user_id)['username'];

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
    
?>
