<?php
require_once "app/models/Visit.php";

class VisitController {
    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data && isset($data["ip"]) && isset($data["city"]) && isset($data["device"])) {
            Visit::add($data["ip"], $data["city"], $data["device"]);
            echo json_encode(["success" => true]);
        }
    }
}
