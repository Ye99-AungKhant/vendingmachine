<?php require("./views/components/header.php"); ?>
<div class="container">
    <div class="content">
        <h2>Transaction List</h2>

        <div class="sorting">
            <a href="transaction?page=<?php echo $page; ?>&sortBy=total_price&sortOrder=ASC">Sort by Price (Low to High)</a> |
            <a href="transaction?page=<?php echo $page; ?>&sortBy=total_price&sortOrder=DESC">Sort by Price (High to Low)</a> |
            <a href="transaction?page=<?php echo $page; ?>&sortBy=quantity&sortOrder=ASC">Sort by Quantity (Low to High)</a> |
            <a href="transaction?page=<?php echo $page; ?>&sortBy=quantity&sortOrder=DESC">Sort by Quantity (High to Low)</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>User Name</th>
                <th>Qty</th>
                <th>Total Price</th>
            </tr>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= $transaction->id ?></td>
                    <td><?= $transaction->product_name ?></td>
                    <td><?= $transaction->user_name ?></td>
                    <td><?= $transaction->quantity ?></td>
                    <td><?= $transaction->total_price ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&sortBy=<?= $sortBy ?>&sortOrder=<?= $sortOrder ?>">Previous</a>
            <?php endif; ?>

            <a href="?page=<?= $page + 1 ?>&sortBy=<?= $sortBy ?>&sortOrder=<?= $sortOrder ?>">Next</a>
        </div>
    </div>
</div>
<?php require("./views/components/footer.php"); ?>