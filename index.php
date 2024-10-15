<?php
require('vendor/autoload.php');
require('core/bootstrap.php');
error_reporting(E_ERROR | E_PARSE);
Router::load('routes.php')->direct(Request::uri(), $_SERVER['REQUEST_METHOD']);
