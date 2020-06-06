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
    
?>
