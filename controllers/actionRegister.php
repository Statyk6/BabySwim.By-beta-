<?php 
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/
    
require "../models/db_connect.php"; // Подключаемся к базе данных

$errors = []; // Массив для хранения ошибок

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $mysqli->real_escape_string($_POST["new_name"]); // Защита от SQL-инъекций
    $new_email = $mysqli->real_escape_string($_POST["new_email"]); // Защита от SQL-инъекций
    $new_password = $_POST["new_password"]; // Пароль не требуется экранировать
    $retype_password = $_POST["retype_password"]; // Пароль не требуется экранировать
    $phone_number = $mysqli->real_escape_string($_POST["phone_number"]); // Защита от SQL-инъекций
    $score = 0; // Защита от SQL-инъекций
    $superuser; // Защита от SQL-инъекций

    // Проверка имени на соответствие требованиям
    if (!preg_match('/^[A-Za-zА-Яа-я]+$/u', $new_name)) {
        $errors[] = "Имя должно состоять только из букв русского или английского алфавита.";
    }

    // Проверка на существование e-mail
    $check_email_query = "SELECT * FROM users WHERE email = '$new_email'";
    $result = $mysqli->query($check_email_query);
    if ($result->num_rows > 0) {
        // Этот e-mail уже существует
        $errors[] = "Этот e-mail уже занят.";
    } else {
        // Проверка на совпадение паролей
        if ($new_password === $retype_password) {
            // Проверки на пароль и номер телефона
            $allowed_special_chars = ['!', '@', '#', '$', '%', '&'];

            if (
                strlen($new_password) < 8 ||
                !preg_match('/[A-Z]/', $new_password) ||
                !preg_match('/[' . preg_quote(implode('', $allowed_special_chars), '/') . ']/', $new_password)
            ) {
                // Пароль не соответствует требованиям
                $errors[] = "Пароль должен быть минимум 8 английских букв, иметь как минимум 1 заглавную букву, 1 символ и цифру.";
            } else if (strlen($phone_number) !== 13 || !is_numeric($phone_number)) {
                // Номер телефона не соответствует формату
                $errors[] = "Телефон должен быть в формате +375*******";
            } else {
                // Создание таблицы users, если она ещё не существует
                $create_table_query = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    phone VARCHAR(255) NOT NULL,
                    superuser TINYINT(1) NOT NULL,
                    score TINYINT(1) NOT NULL,
                    datereg DATETIME DEFAULT CURRENT_TIMESTAMP,
                    last_cisit DATETIME DEFAULT CURRENT_TIMESTAMP
                )";
                if ($mysqli->query($create_table_query) === true) {
                    // Теперь таблица 'users' существует или была успешно создана

                    // Хеширование пароля
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                    // Подготовка и выполнение запроса на вставку нового пользователя
                    $sql = "INSERT INTO users (name, email, password, phone, score, superuser) VALUES ('$new_name', '$new_email', '$hashed_password', '$phone_number', '0', '0')";
                    if ($mysqli->query($sql) === true) {
                        // Регистрация успешно завершена
                        // Вам не нужно выводить успех здесь, так как перенаправление на главную страницу выполнится ниже
                    } else {
                        // Ошибка при регистрации
                        $errors[] = "Ошибка: " . $mysqli->error;
                    }
                } else {
                    $errors[] = "Ошибка при создании таблицы: " . $mysqli->error;
                }
            }
        } else {
            // Пароли не совпадают
            $errors[] = "Пароли не совпадают.";
        }
    }
    header("Refresh: 1; URL=/register");
}

// Закрытие соединения с базой данных
$mysqli->close();

if (count($errors) === 0) {
    // Перенаправление на главную страницу
    echo "Вы успешно зарегистрировались!<br>Через пару секунд вы будете перенаправлены обратно - ожидайте.";
    header("Refresh: 1; URL=/");
} else {
    // Ошибка, выведите ошибки под формой
    // Например, используйте цикл для вывода ошибок
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";
    }
}
?>
