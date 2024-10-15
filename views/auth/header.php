<?php
session_start();
$authUser = $_SESSION['auth_user'] ?? null;
if ($authUser) {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine System</title>
    <link rel="stylesheet" href="./views/styles/index.css">
    <link rel="stylesheet" href="./views/styles/form.css">
</head>

<body>