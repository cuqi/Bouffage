<?php include '../view/head.php'; ?>
<main class="nofloat">
    <h1>Add your recipe:</h1>
    <form action="index.php" method="post" id="add_product_form">
        <!-- <label>Recipe ID:</label>
        <input type="text" name="recipeID"
               value=""> -->
        <br>

        <label>Cuisine:</label>
        <input type="text" name="cuisine" 
               value="">
        <br>

        <label>Description:</label>
        <textarea name="description" rows="10"
                  cols="50">
       </textarea>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Submit">
        
    </form>
</main>
<?php include '../view/foot.php'; ?>