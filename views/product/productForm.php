<?php
$isCreate;
if ($product ?? false) {
    $isCreate = false;
} else {
    $isCreate = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine System</title>
    <link rel="stylesheet" href="../../views/styles/form.css">
</head>

<body>
    <div class="form-container">
        <h2>
            <?php if ($isCreate) {
                echo "Create";
            } else {
                echo "Update";
            }
            ?> Product</h2>
        <form action="<?php if ($isCreate) {
                            echo "";
                        } else {
                            echo "update";
                        } ?>"
            method="POST">
            <div class="input-field">
                <label for="name">Name</label>
                <input class="inputField" type="text" id="name" name="name" value="<?= $product->name ?? '' ?>" require>
                <span style="color: red;"><?php echo $errors['name'] ?? ''; ?></span>
            </div>
            <div class="input-field">
                <label for="price">Price</label>
                <input class="inputField" type="text" id="price" name="price" value="<?= $product->price ?? '' ?>" require>
                <span style="color: red;"><?php echo $errors['price'] ?? ''; ?></span>
            </div>
            <div class="input-field">
                <label for="qtyAvailable">Quantity Available</label>
                <input class="inputField" type="number" id="qtyAvailable" name="qtyAvailable" value="<?= $product->quantityAvailable ?? '' ?>" require>
                <span style="color: red;"><?php echo $errors['qtyAvailable'] ?? ''; ?></span>
            </div>
            <input type="hidden" name="id" value="<?= $product->id ?? '' ?>">
            <button type="submit"> <?php if ($isCreate) {
                                        echo "Create";
                                    } else {
                                        echo "Update";
                                    }
                                    ?></button>
        </form>
    </div>
</body>

</html>