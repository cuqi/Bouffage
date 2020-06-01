<?php include '../view/head.php'; ?>
<main class="nofloat">
    <h1>Add your recipe:</h1>
    <form action="index.php" method="post" id="add_product_form">
        <label>Recipe ID:</label>
        <input type="text" name="code"
               value="<?php echo htmlspecialchars($recipe['recipe_id']); ?>">
        <br>

        <label>Cuisine:</label>
        <input type="text" name="price" 
               value="<?php echo $recipe['cuisine']; ?>">
        <br>

        <label>Discount Percent:</label>
        <input type="text" name="discount_percent" 
               value="<?php echo $product['discountPercent']; ?>">
        <br>

        <label>Description:</label>
        <textarea name="description" rows="10"
                  cols="50"><?php echo $product['description']; ?></textarea>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Submit">
        
    </form>
</main>
<?php include '../view/foot.php'; ?>