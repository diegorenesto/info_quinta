<?php

class db
{
    private static ?PDO $db = null;

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
                die("Errore di connessione al database: " . $e->getMessage());
            }
        }

        return self::$db;
    }
}