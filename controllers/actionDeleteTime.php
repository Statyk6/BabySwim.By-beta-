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
    $deleteQuery = "DELETE FROM timetables WHERE id = $id";

    if ($mysqli->query($deleteQuery) === true) {
        echo "Расписание успешно удалено.";
    } else {
        echo "Ошибка при удалении расписания: " . $mysqli->error;
    }
} else {
    echo "Отсутствует параметр id для удаления расписания.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Refresh: 1; URL=/timetables");
?>
