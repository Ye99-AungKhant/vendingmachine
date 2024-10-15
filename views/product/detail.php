<?php require("./views/components/header.php"); ?>
<div class="container">
    <div class="product-card">
        <div class="product-name"><?= $product->name ?></div>
        <div class="product-price">Price: <?= $product->price ?> USD</div>
        <div class="product-quantity">Available Quantity: <?= $product->quantityAvailable ?></div>

        <form class="buy-form" action="/product/purchase" method="POST">
            <input type="hidden" name="productId" value="<?= $product->id ?? '' ?>">
            <input type="hidden" name="userId" value="<?= $_SESSION["auth_user"]->id ?? '' ?>">
            <input type="hidden" name="price" value="<?= $product->price ?? '' ?>">
            <label for="buyQuantity">Quantity:</label>
            <input type="number" id="buyQuantity" name="qty" min="1" max="<?= $product->quantityAvailable ?>" required>
            <span style="color: red;"><?php echo $errors['qty'] ?? ''; ?></span>
            <input type="submit" value="Buy Now">
        </form>
    </div>
</div>

<?php require("./views/components/footer.php"); ?>