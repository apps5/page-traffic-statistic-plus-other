<?php
require_once "config/database.php";

class Visit {
    public static function add($ip, $city, $device) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO visits (ip, city, device) VALUES (:ip, :city, :device)");
        $stmt->bindValue(":ip", $ip);
        $stmt->bindValue(":city", $city);
        $stmt->bindValue(":device", $device);
        $stmt->execute();
    }

    public static function getVisitsByHour() {
        $db = Database::getInstance();
        $data = [];
        for ($i = 0; $i < 24; $i++) $data[$i] = 0;

        $result = $db->query("SELECT strftime('%H', visit_time) as hour, COUNT(*) as count FROM visits GROUP BY hour");
        while ($row = $result->fetchArray()) {
            $data[(int)$row["hour"]] = $row["count"];
        }
        return $data;
    }

    public static function getVisitsByCity() {
        $db = Database::getInstance();
        $data = [];
        $result = $db->query("SELECT city, COUNT(*) as count FROM visits GROUP BY city");
        while ($row = $result->fetchArray()) {
            $data[$row["city"]] = $row["count"];
        }
        return $data;
    }
}
