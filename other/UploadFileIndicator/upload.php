<?php
class Upload {
  function run (){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
      $uploadDir = "files/";
      if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
      }
  
      $fileName = basename($_FILES["file"]["name"]);
      $filePath = $uploadDir . $fileName;
      $delimiter = ';';
  
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
          $fileContent = file_get_contents($filePath);
          $lines = explode($delimiter, $fileContent);
          
          $result = [];
          foreach ($lines as $line) {
              $digitCount = preg_match_all('/\d/', $line);
              $result[] = htmlspecialchars($line) . " = " . $digitCount;
          }
  
          echo json_encode(["success" => true, "message" => "Файл загружен!", "data" => $result]);
      } else {
          echo json_encode(["success" => false, "message" => "Ошибка загрузки файла."]);
      }
    } else {
        echo json_encode(["success" => false, "message" => "Неверный запрос."]);
    }
  }
}
$handler = new Upload();
$handler->run();
?>
