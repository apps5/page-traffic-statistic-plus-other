document.getElementById("uploadForm").addEventListener("submit", function(event) {
  event.preventDefault();

  let fileInput = document.getElementById("fileInput");
  let delimiterInput = document.getElementById("delimiterInput");
  let statusIndicator = document.getElementById("statusIndicator");
  let resultDiv = document.getElementById("result");

  if (!fileInput.files.length) {
      alert("Выберите файл.");
      return;
  }

  let formData = new FormData();
  formData.append("file", fileInput.files[0]);

  fetch("upload.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          statusIndicator.className = "indicator green";
          resultDiv.innerHTML = "<h3>Результат:</h3>";
          data.data.forEach(line => {
              resultDiv.innerHTML += `<p>${line}</p>`;
          });
      } else {
          statusIndicator.className = "indicator red";
          resultDiv.innerHTML = `<p style="color:red;">Ошибка: ${data.message}</p>`;
      }
  })
  .catch(error => {
      statusIndicator.className = "indicator red";
      resultDiv.innerHTML = `<p style="color:red;">Ошибка сети</p>`;
  });
});
