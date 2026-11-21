<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

class Database{
    private static ?PDO $connection = null;

    public static function connect(): PDO{
        if (self::$connection === null) {
            $host = "sql103.infinityfree.com";
            $db   = "if0_42504514_staynest_db";
            $user = "if0_42504514";
            $pass = "IshikaPooja";

            $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
            try{
                self::$connection = new PDO(
                    $dsn,
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                // Let the calling page/API handle the connection failure.
                // Landing page components can render their own empty states.
                throw $e;
            }
        }
        return self::$connection;
    }
}
