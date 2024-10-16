<?php
$userRole = checkUserRole('Admin');
$authUser = $_SESSION['auth_user'] ?? null;
if (!$authUser) {
    header('Location: login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine System</title>
    <link rel="stylesheet" href="/views/styles/index.css">
</head>

<body>
    <nav class="navbar">
        <ul>

            <li><a href="/">Products</a></li>
            <?php if ($userRole == "Admin"): ?>
                <li><a href="transaction">Transaction</a></li>
                <li><a href="user">User</a></li>
            <?php endif; ?>

            <form action="/logout" method="post">
                <button type="submit">Logout</button>
            </form>
        </ul>
    </nav>