<?php
session_start();
$authUser = $_SESSION['auth_user'];
if (!isset($authUser)) {
    header('Location: login');
    exit;
}
if ($authUser->role != 'Admin') {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        .navbar {
            width: 100%;
            background-color: #333;
            padding: 1em 0;
            color: white;
        }

        .navbar ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
        }

        .navbar ul li {
            margin: 0 20px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .navbar ul li a:hover {
            color: #ff9800;
        }

        .container {
            display: flex;
            margin-top: 20px;
            padding: 20px;
        }

        .content {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .content-box {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #e0e0e0;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <ul>
            <div>
                <li><a href="#">Products</a></li>
                <li><a href="#">User</a></li>
                <li><a href="#">Transaction</a></li>
            </div>
            <div>
                <form action="logout" method="post">
                    <button type="submit">Logout</button>
                </form>
            </div>
        </ul>
    </nav>