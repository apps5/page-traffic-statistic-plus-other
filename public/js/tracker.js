document.addEventListener("DOMContentLoaded", function () {
  fetch("https://api.ipify.org?format=json")
      .then(response => response.json())
      .then(data => fetch(`https://ipapi.co/${data.ip}/json/`))
      .then(response => response.json())
      .then(data => fetch("/track", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ ip: data.ip, city: data.city || "Неизвестно", device: navigator.userAgent })
      }));
});
