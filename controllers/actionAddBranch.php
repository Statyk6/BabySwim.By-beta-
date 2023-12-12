<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

require "../models/db_connect.php"; // Подключаемся к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $branchName = $_POST['branchName'];
    $branchAddress = $_POST['branchAddress'];

    // Выполните валидацию данных, если необходимо

    // Запрос для добавления нового филиала в таблицу branches
    $insertQuery = "INSERT INTO branches (branch, adress) VALUES (?, ?)";

    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param("ss", $branchName, $branchAddress);

    if ($stmt->execute()) {
        echo "Новый филиал успешно добавлен.";
    } else {
        echo "Ошибка при добавлении нового филиала: " . $stmt->error;
    }
} else {
    echo "Неверный метод запроса.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Location: /branches"); 
?>