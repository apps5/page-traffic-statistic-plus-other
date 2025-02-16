<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["login"] === "admin" && $_POST["password"] === "admin") {
        $_SESSION["auth"] = true;
        header("Location: /stats");
        exit;
    } else {
        $error = "Неверные учетные данные!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Вход в систему</h2>
                        <?php if (isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="login" class="form-label">Логин</label>
                                <input type="text" name="login" id="login" class="form-control" placeholder="Введите логин" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Введите пароль" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Войти</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
