<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd751713988987e9331980363e24189ce
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'AdminController' => __DIR__ . '/../..' . '/controllers/AdminController.php',
        'ApiProductsController' => __DIR__ . '/../..' . '/controllers/ApiProductsController.php',
        'ApiTransactionController' => __DIR__ . '/../..' . '/controllers/ApiTransactionController.php',
        'ApiUserController' => __DIR__ . '/../..' . '/controllers/ApiUserController.php',
        'App' => __DIR__ . '/../..' . '/core/App.php',
        'ComposerAutoloaderInitd751713988987e9331980363e24189ce' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInitd751713988987e9331980363e24189ce' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Connetion' => __DIR__ . '/../..' . '/core/database/Connection.php',
        'Firebase\\JWT\\BeforeValidException' => __DIR__ . '/..' . '/firebase/php-jwt/src/BeforeValidException.php',
        'Firebase\\JWT\\CachedKeySet' => __DIR__ . '/..' . '/firebase/php-jwt/src/CachedKeySet.php',
        'Firebase\\JWT\\ExpiredException' => __DIR__ . '/..' . '/firebase/php-jwt/src/ExpiredException.php',
        'Firebase\\JWT\\JWK' => __DIR__ . '/..' . '/firebase/php-jwt/src/JWK.php',
        'Firebase\\JWT\\JWT' => __DIR__ . '/..' . '/firebase/php-jwt/src/JWT.php',
        'Firebase\\JWT\\JWTExceptionWithPayloadInterface' => __DIR__ . '/..' . '/firebase/php-jwt/src/JWTExceptionWithPayloadInterface.php',
        'Firebase\\JWT\\Key' => __DIR__ . '/..' . '/firebase/php-jwt/src/Key.php',
        'Firebase\\JWT\\SignatureInvalidException' => __DIR__ . '/..' . '/firebase/php-jwt/src/SignatureInvalidException.php',
        'ProductsController' => __DIR__ . '/../..' . '/controllers/ProductsController.php',
        'QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'Request' => __DIR__ . '/../..' . '/core/Request.php',
        'Router' => __DIR__ . '/../..' . '/core/Router.php',
        'TransactionController' => __DIR__ . '/../..' . '/controllers/TransactionController.php',
        'User' => __DIR__ . '/../..' . '/controllers/UserController.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/UserController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd751713988987e9331980363e24189ce::$classMap;

        }, null, ClassLoader::class);
    }
}
