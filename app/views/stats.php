<?php
session_start();

if (!isset($_SESSION["auth"])) {
    header("Location: /login");
    exit;
}

require_once "config/database.php";
require_once "app/models/Visit.php";

$hourlyData = Visit::getVisitsByHour();
$cityData = Visit::getVisitsByCity();
$totalVisits = array_sum($hourlyData);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Статистика посещений</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 100%;
            height: 300px;
            max-height: 300px;
            position: relative;
        }
        canvas {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="mb-4">Аналитика посещений</h1>
                <h4>Общее количество посещений: <?= $totalVisits ?></h4>
            </div>
        </div>

        <div class="row d-flex flex-wrap justify-content-center">
            <div class="col-md-6 col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="text-center">Количество посещений по времени</h4>
                        <div class="chart-container">
                            <canvas id="visitsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="text-center">Распределение посещений по городам</h4>
                        <div class="chart-container">
                            <canvas id="cityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 text-center">
            <div class="col-12">
                <a href="/logout" class="btn btn-danger">Выйти</a>
            </div>
        </div>
    </div>

    <script>
        const hourlyData = <?= json_encode(array_values($hourlyData)) ?>;
        const hourLabels = [...Array(24).keys()].reverse().map(h => h + ":00"); // Часы от 23 до 0
        const cityData = <?= json_encode(array_values($cityData)) ?>;
        const cityLabels = <?= json_encode(array_keys($cityData)) ?>;

        function getRandomColor() {
            return `hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`;
        }

        const dynamicColors = cityLabels.map(() => getRandomColor());

        new Chart(document.getElementById("visitsChart"), {
            type: "line",
            data: {
                labels: hourLabels,
                datasets: [{
                    label: "Количество посещений",
                    data: hourlyData.reverse(),
                    backgroundColor: "rgba(54, 162, 235, 0.7)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { 
                        beginAtZero: true, 
                        title: { display: true, text: "Количество посещений" },
                        ticks: { stepSize: 1 }
                    },
                    y: { 
                        title: { display: true, text: "Время (часы)" } 
                    }
                }
            }
        });

        new Chart(document.getElementById("cityChart"), {
            type: "pie",
            data: {
                labels: cityLabels,
                datasets: [{
                    data: cityData,
                    backgroundColor: dynamicColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
