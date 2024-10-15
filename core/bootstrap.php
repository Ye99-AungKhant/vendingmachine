<?php
require('functions.php');

App::bind("config", require('./config.php'));
App::bind("database", new QueryBuilder(
    Connetion::make(App::get("config")['database'])
));

define('JWT_SECRET', 'vendingMachine'); // Secret key for JWT
define('JWT_EXPIRATION', 3600);
