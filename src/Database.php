<?php

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            // Tests can define DB_PATH as ':memory:' to avoid touching the real DB
            $path = defined('DB_PATH') ? DB_PATH : __DIR__ . '/../db/database.sqlite';
            self::$instance = new PDO('sqlite:' . $path);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            self::loadSchema(self::$instance);
        }
        return self::$instance;
    }

    // Reset for testing — call between test cases if needed
    public static function reset(): void {
        self::$instance = null;
    }

    private static function loadSchema(PDO $db): void {
        $sql = file_get_contents(__DIR__ . '/../db/schema.sql');
        $db->exec($sql);
    }
}
