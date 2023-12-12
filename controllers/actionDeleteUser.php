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

    // Запрос для получения значения поля superuser из базы данных
    $checkSuperuserQuery = "SELECT superuser FROM users WHERE id = '$id'";
    $superuserResult = $mysqli->query($checkSuperuserQuery);

    if ($superuserResult) {
        $superuserData = $superuserResult->fetch_assoc();

        if ($superuserData) {
            $isSuperuser = $superuserData['superuser'];

            if ($isSuperuser == 0) { // Проверяем, что superuser равно 0 (false)
                // Запрос для удаления пользователя из базы данных
                $deleteQuery = "DELETE FROM users WHERE id = '$id'";
                
                if ($mysqli->query($deleteQuery) === true) {
                    echo "Пользователь успешно удален.";
                } else {
                    echo "Ошибка при удалении пользователя: " . $mysqli->error;
                }
            } else {
                echo "Вы не можете удалить пользователя с ролью Администратора.";
            }
        } else {
            echo "Пользователь с таким id не найден.";
        }
    } else {
        echo "Ошибка при запросе к базе данных: " . $mysqli->error;
    }
} else {
    echo "Отсутствует параметр id для удаления пользователя.";
}
// Перенаправляем пользователя обратно на страницу
echo "<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
header("Refresh: 1; URL=/users");
?>
