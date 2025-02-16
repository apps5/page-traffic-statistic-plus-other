<?php
session_start();

require "config/database.php";
require "app/controllers/VisitController.php";
require "app/controllers/AuthController.php";
require "app/controllers/StatsController.php";

$uri = trim($_SERVER["REQUEST_URI"], "/");

switch ($uri) {
    case "":
        include "public/index.html";
        break;
    case "track":
        VisitController::store();
        break;
    case "login":
        AuthController::login();
        break;
    case "logout":
        AuthController::logout();
        break;
    case "stats":
        StatsController::show();
        break;
    default:
        http_response_code(404);
        echo "404 - Страница не найдена";
        break;
}
