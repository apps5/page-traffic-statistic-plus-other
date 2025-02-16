<?php
class Database {
    private static $instance = null;
    private $db;

    private function __construct() {
        $this->db = new SQLite3(__DIR__ . "/database.db");
        $this->db->exec("CREATE TABLE IF NOT EXISTS visits (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ip TEXT,
            city TEXT,
            device TEXT,
            visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->db;
    }
}
