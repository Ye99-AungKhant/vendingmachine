<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function dd($data)
{
    echo "<pre>";
    die(var_dump($data));
}

function view($name, $data = [])
{
    extract($data);
    return require("./views/$name.php");
}

function checkUserRole($role)
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['auth_user']) && $_SESSION['auth_user']->role === $role) {
        return true;
    }

    return false;
}


function validateRequired($field, $fieldName)
{
    if (empty($field)) {
        return "$fieldName is required";
    }
    return "";
}

function validateNumeric($field, $fieldName)
{
    if (!is_numeric($field)) {
        return "$fieldName must be a valid number";
    }
    return "";
}

function validateNonNegative($field, $fieldName)
{
    if (intval($field) < 0) {
        return "$fieldName must be a non-negative number";
    }
    return "";
}

function validateEmail($field, $fieldName)
{
    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return "$fieldName must be a valid email address.";
    }
    return "";
}

function validatePassword($field, $fieldName)
{
    if (strlen($field) < 8) {
        return "$fieldName must be at least 8 characters long.";
    }
    return "";
}

function validateInput($input, $validations)
{
    $errors = [];
    foreach ($validations as $fieldName => $validationFns) {
        foreach ($validationFns as $validationFn) {
            $error = $validationFn($input[$fieldName], ucfirst($fieldName));
            if ($error) {
                $errors[$fieldName] = $error;
                break;
            }
        }
    }
    return $errors;
}


function responsejson($data, $status)
{
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
}


function authorizeRequest()
{
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Authorization header not found']);
        exit;
    }

    $authHeader = $headers['Authorization'];
    $jwt = str_replace('Bearer ', '', $authHeader);

    try {
        $decoded = JWT::decode($jwt, new Key(JWT_SECRET, 'HS256'));

        return true;
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid token: ' . $e->getMessage()]);
        return false;
    }
}
