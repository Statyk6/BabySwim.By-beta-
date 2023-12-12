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

    // Запрос для удаления записи из таблицы reservations
    $deleteQuery = "DELETE FROM seats WHERE group_name = $id";

    if ($mysqli->query($deleteQuery) === true) {
        echo "Места успешно удалены.";
    } else {
        echo "Ошибка при удалении мест: " . $mysqli->error;
    }
} else {
    echo "Отсутствует параметр id для удаления мест.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Refresh: 1; URL=/seats");
?>
