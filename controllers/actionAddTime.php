<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

require "../models/db_connect.php"; // Подключаемся к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получим данные из формы
    $branchId = $_POST['branchId'];
    $groupId = $_POST['groupId'];
    $dayOfWeek = $_POST['dayOfWeek'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];

    // Подготовим SQL-запрос для вставки новой записи
    $stmt = $mysqli->prepare("INSERT INTO timetables (branch_name, group_name, day, time_start, time_end) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $branchId, $groupId, $dayOfWeek, $time_start, $time_end);

    if ($stmt->execute()) {
        echo "Новое расписание успешно добавлено.";
    } else {
        echo "Ошибка при добавлении нового расписания: " . $stmt->error;
    }
} else {
    echo "Неверный метод запроса.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Location: /timetables"); 
?>
