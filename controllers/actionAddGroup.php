<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

require "../models/db_connect.php"; // Подключаемся к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group_name = $_POST['groupName']; // Исправлено: правильное имя поля для названия группы
    $branch_id = $_POST['branchId']; // Исправлено: правильное имя поля для выбора филиала

    // Выполните валидацию данных, если необходимо

    // Запрос для добавления новой группы в таблицу groups
    $insertQuery = "INSERT INTO `groups` (group_name, branch_name) VALUES (?, ?)";

    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param("si", $group_name, $branch_id);

    if ($stmt->execute()) {
        echo "Новая группа успешно добавлена.";
    } else {
        echo "Ошибка при добавлении новой группы: " . $stmt->error;
    }
} else {
    echo "Неверный метод запроса.";
}

// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Location: /groups"); 
?>
