<?php

class db_conn
{
    private static ?PDO $db; // ? prima di PDO per settare una variabile a null

    public static function getDB(array $config): PDO
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    $config['dsn'],
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (PDOException $e) {
                self::$db = null;
            }

        }

        return self::$db;
    }
}