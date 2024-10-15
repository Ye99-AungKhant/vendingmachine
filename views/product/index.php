<?php require("./views/components/header.php"); ?>

<div class="container">
    <div class="content">
        <div class="productBtn">
            <h2>Products</h2>
            <a href="product/create">Create Product</a>
        </div>

        <div class="sorting">
            <a href="product?page=<?php echo $currentPage; ?>&sortBy=price&orderBy=ASC">Sort by Price (Low to High)</a> |
            <a href="product?page=<?php echo $currentPage; ?>&sortBy=price&orderBy=DESC">Sort by Price (High to Low)</a> |
            <a href="product?page=<?php echo $currentPage; ?>&sortBy=quantityAvailable&orderBy=ASC">Sort by Quantity Available (Low to High)</a> |
            <a href="product?page=<?php echo $currentPage; ?>&sortBy=quantityAvailable&orderBy=DESC">Sort by Quantity Available (High to Low)</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity Available</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($products as $product):
            ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td><?= $product->price ?> USD</td>
                    <td><?= $product->quantityAvailable ?></td>
                    <td class="actionBtn">
                        <form action="product/purchase" method="get">
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <button type="submit">Purchase</button>
                        </form>
                        <?php if ($userRole == "Admin"): ?>
                            <form action="product/edit" method="get">
                                <input type="hidden" name="id" value="<?= $product->id ?>">
                                <button type="submit">Edit</button>
                            </form>
                            <form action="product/delete" method="post">
                                <input type="hidden" name="id" value="<?= $product->id ?>">
                                <button type="submit">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="product?page=<?php echo $currentPage - 1; ?>&sortBy=<?php echo $sortBy; ?>&orderBy=<?php echo $orderBy; ?>">&laquo; Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $currentPage): ?>
                    <strong><?php echo $i; ?></strong>
                <?php else: ?>
                    <a href="product?page=<?php echo $i; ?>&sortBy=<?php echo $sortBy; ?>&orderBy=<?php echo $orderBy; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="product?page=<?php echo $currentPage + 1; ?>&sortBy=<?php echo $sortBy; ?>&orderBy=<?php echo $orderBy; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require("./views/components/footer.php"); ?>