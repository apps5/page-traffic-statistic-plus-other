<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла .txt</title>
    <link rel="stylesheet" href="src/styles.css">
</head>
<body>
    <div class="container">
        <h2>Загрузите файл .txt</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" name="file" id="fileInput" accept=".txt" required>
            <button type="submit">Загрузить</button>
        </form>
        <div id="statusIndicator" class="indicator"></div>
        <div id="result"></div>
    </div>

    <script src="src/script.js"></script>
</body>
</html>
