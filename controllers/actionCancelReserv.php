<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

require "../models/db_connect.php"; // Подключаемся к базе данных

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Запрос для обновления статуса записи в таблице reservations
    $updateQuery = "UPDATE reservations SET status = 'Отменена' WHERE id = $id";

    if ($mysqli->query($updateQuery) === true) {
        echo "Запись успешно отменена.";
    } else {
        echo "Ошибка при отмене записи: " . $mysqli->error;
    }
} else {
    echo "Отсутствует параметр id для отмены записи.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Refresh: 1; URL=/reservations");
?>
