<?php
class User
{
    public $id;
    public $name;
    public $email;
    public $role;
    public function __construct($id, $name, $email, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
}

class UserController
{
    public function index()
    {
        $users = App::get("database")->selectAll('users');

        view("user/index", [
            "users" => $users
        ]);
    }

    public function register()
    {
        view("auth/register");
    }
    public function login()
    {
        view("auth/login");
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

        $hashPassword = password_hash($password, PASSWORD_BCRYPT);

        if (!empty($errors)) {
            view("auth/register", ["errors" => $errors]);
        }
        $user = App::get("database")->insert([
            "name" => $name,
            "email" => $email,
            "password" => $hashPassword,
            "role" => 'User',
        ], 'users');
        if ($user) {
            $authenticated = new User($user->id, $user->name, $user->email, $user->role);
            $_SESSION["auth_user"] = $authenticated;
            header("Location: /");
        }
    }

    public function checkUser()
    {
        session_start();

        $errors = [];
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $validations = [
            'email' => ['validateRequired', 'validateEmail'],
            'password' => ['validateRequired']
        ];

        $errors = validateInput($_POST, $validations);
        if (!empty($errors)) {
            view("auth/login", ["errors" => $errors]);
        }

        $user = App::get("database")->where("email", "=", $email, 'users');

        if (password_verify($password, $user->password) && $email == $user->email) {
            $authenticated = new User($user->id, $user->name, $user->email, $user->role);
            $_SESSION['auth_user'] = $authenticated;
            header("Location: /");
        } else {
            $errors['password'] = "Your credential do not match. Try again!";
            view("auth/login", ["errors" => $errors]);
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: login");
    }
}
