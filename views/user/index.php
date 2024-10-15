<?php require("./views/components/header.php"); ?>

<div class="container">
    <div class="content">
        <h2>User List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->role ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php require("./views/components/footer.php"); ?>