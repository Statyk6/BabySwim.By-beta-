<?php 
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

require "../models/db_connect.php"; // Подключаемся к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $mysqli->real_escape_string($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Пользователь успешно авторизован
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['superuser'] = $user['superuser'];
            $_SESSION['expire'] = time() + 86400;

            // Обновляем last_visit
            $currentDateTime = date("Y-m-d H:i:s");
            $updateLastVisitSql = "UPDATE users SET last_visit = '$currentDateTime' WHERE id = " . $user['id'];
            $mysqli->query($updateLastVisitSql);

            // Перенаправляем пользователя на главную страницу
            header("Location: /");
            exit();
        } else {
            echo "Ошибка: Неверный e-mail или пароль.";
        }
    } else {
        echo "Ошибка: Неверный e-mail или пароль.";
    }
    header("Refresh: 1; URL=/");
}

$mysqli->close();
?>