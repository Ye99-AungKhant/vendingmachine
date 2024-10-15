<?php
class Connetion
{
    public static function make($config)
    {
        try {
            return $pdo = new PDO("{$config['host']};dbname={$config['dbName']}", $config['username']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
