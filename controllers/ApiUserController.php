<?php

use Firebase\JWT\JWT;

class ApiUserController
{
    public function index()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }
        $users = App::get("database")->selectAll('users');

        responsejson(["users" => $users], 200);
    }

    public function store()
    {
        $errors = [];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $validations = [
            'name' => ['validateRequired'],
            'email' => ['validateRequired', 'validateEmail'],
            'password' => ['validateRequired', 'validatePassword']
        ];

        $errors = validateInput($_POST, $validations);
        if (!empty($errors)) {
            responsejson(["errors" => $errors], 400);
        }

        $hashPassword = password_hash($password, PASSWORD_BCRYPT);

        $user = App::get("database")->insert([
            "name" => $name,
            "email" => $email,
            "password" => $hashPassword,
            "role" => 'User',
        ], 'users');
        if ($user) {
            $authenticated = new User($user->id, $user->name, $user->email, $user->role);
            $token = [
                'exp' => time() + JWT_EXPIRATION,
                'user' => $authenticated
            ];
            $jwt = JWT::encode($token, JWT_SECRET, 'HS256');
            responsejson(["token" => $jwt], 200);
        }
    }

    public function login()
    {
        $errors = [];
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $validations = [
            'email' => ['validateRequired', 'validateEmail'],
            'password' => ['validateRequired']
        ];

        $errors = validateInput($_POST, $validations);
        if (!empty($errors)) {
            responsejson(["errors" => $errors], 400);
        }

        $user = App::get("database")->where("email", "=", $email, 'users');

        if (password_verify($password, $user->password) && $email == $user->email) {
            $authenticated = new User($user->id, $user->name, $user->email, $user->role);

            $token = [
                'exp' => time() + JWT_EXPIRATION,
                'user' => $authenticated
            ];
            $jwt = JWT::encode($token, JWT_SECRET, 'HS256');
            responsejson(["token" => $jwt], 200);
        } else {
            $errors['password'] = "Your credential do not match. Try again!";
            responsejson(["errors" => $errors], 400);
        }
    }
}
