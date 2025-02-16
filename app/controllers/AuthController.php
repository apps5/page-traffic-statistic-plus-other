<?php
class AuthController {
    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["login"] === "admin" && $_POST["password"] === "password") {
            $_SESSION["auth"] = true;
            header("Location: /stats");
            exit;
        }
        include "app/views/login.php";
    }

    public static function logout() {
        session_destroy();
        header("Location: /login");
    }
}
