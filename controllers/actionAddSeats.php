<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

require "../models/db_connect.php"; // Подключаемся к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $groupId = $_POST['groupId'];
    $countSeats = $_POST['count_seats'];

    // Запрос для добавления мест в группу в таблицу seats
    $insertQuery = "INSERT INTO `seats` (group_name, count_seats) VALUES (?, ?)";

    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param("ii", $groupId, $countSeats);

    if ($stmt->execute()) {
        echo "Места успешно добавлены в группу.";
    } else {
        echo "Ошибка при добавлении мест в группу: " . $stmt->error;
    }
} else {
    echo "Неверный метод запроса.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Location: /seats"); 
?>
