<?php
$router->get("user", "UserController@index");
$router->get("register", "UserController@register");
$router->get("login", "UserController@login");
$router->post("register", "UserController@store");
$router->post("login", "UserController@checkUser");
$router->post("logout", "UserController@logout");


$router->get("", "ProductsController@index");
$router->get("product?page={$_GET['page']}&sortBy={$_GET['sortBy']}&orderBy={$_GET['orderBy']}", "ProductsController@index");
$router->get("product/create", "ProductsController@create");
$router->post("product/create", "ProductsController@store");
$router->get("product/edit?id={$_GET['id']}", "ProductsController@edit");
$router->post("product/update", "ProductsController@update");
$router->post("product/delete", "ProductsController@delete");

$router->get("product/purchase?id={$_GET['id']}", "ProductsController@detail");
$router->post("product/purchase", "ProductsController@purchase");

$router->get("transaction", "TransactionController@index");
$router->get("transaction?page={$_GET['page']}&sortBy={$_GET['sortBy']}&sortOrder={$_GET['sortOrder']}", "TransactionController@index");



/****************************************************  api route ********************************************************/
$router->post("api/register", "ApiUserController@store");
$router->post("api/login", "ApiUserController@login");


$router->get("api/user", "ApiUserController@index");

$router->get("api/product?page={$_GET['page']}&sortBy={$_GET['sortBy']}&orderBy={$_GET['orderBy']}", "ApiProductsController@index");
$router->post("api/product/create", "ApiProductsController@store");
$router->post("api/product/update", "ApiProductsController@update");
$router->post("api/product/delete", "ApiProductsController@delete");

$router->get("api/product/purchase?id={$_GET['id']}", "ApiProductsController@detail");
$router->post("api/product/purchase", "ApiProductsController@purchase");

$router->get("api/transaction?page={$_GET['page']}&sortBy={$_GET['sortBy']}&sortOrder={$_GET['sortOrder']}", "ApiTransactionController@index");
