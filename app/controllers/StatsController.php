<?php
require_once "app/models/Visit.php";

class StatsController {
    public static function show() {
        if (!isset($_SESSION["auth"])) {
            header("Location: /login");
            exit;
        }

        $hourlyData = Visit::getVisitsByHour();
        $cityData = Visit::getVisitsByCity();
        
        include "app/views/stats.php";
    }
}
