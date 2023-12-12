<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/
$title = "Управление пользователями";
require "views/head.php"; // Подключаем главные HTML-теги
require "views/left-side.php"; // Подключаем левую часть сайта
require "models/db_connect.php"; // Подключаемся к базе данных
?>

<div class="flexbox-center">
    <div class="flexbox-center-content-1">
        <button class="button-filials" type="button" onclick="window.location.href = '/surganova'">Сурганова 28а</button>
        <button class="button-filials" type="button" onclick="window.location.href = '/odoevskogo'">Одоевского 10к6</button>
    </div>
    <?php
    if (isset($_SESSION['user']) && $_SESSION['superuser'] == true && $_SESSION['expire'] > time()) {
    ?>
        <div class="flexbox-center-content-3">
            <h2>Управление пользователями</h2>
            <p class="alertMsg">
                <b>Важная информация:</b><br>
                1. При нажатии на кнопку удалить, пользователь удаляется без предупреждения!<br>
                2. После удаления, пользователя нельзя восстановить и ему придётся заново регистрироваться!<br>
                3. Вы не можете удалять пользователей с правами Администратора!
            </p>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style='display:none'>ID</th>
                            <th>Имя</th>
                            <th>Эмейл</th>
                            <th>Телефон</th>
                            <th>Баллы</th>
                            <th>Зарегистрирован</th>
                            <th>Последний визит</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Запрос к базе данных для получения пользователей
                        $query = "SELECT * FROM users";
                        $result = $mysqli->query($query);

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $score = $row['score'];
                                $dateRegistered = $row['datereg'];
                                $lastVisit = $row['last_visit'];

                                echo "<tr>";
                                echo "<td data-label='ID' style='display:none'>$id</td>";
                                echo "<td data-label='Имя'>$name</td>";
                                echo "<td data-label='Эмейл'>$email</td>";
                                echo "<td data-label='Телефон'>$phone</td>";
                                echo "<td data-label='Баллы'>$score</td>";
                                echo "<td data-label='Зарегистрирован'>$dateRegistered</td>";
                                echo "<td data-label='Последний визит'>$lastVisit</td>";
                                echo "<td data-label='Действия'><button class='button-delete' type='button' onclick=\"window.location.href='/controllers/actionDeleteUser.php?id=$id'\">Удалить</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    } else {
        require "views/pages/404.php"; // Подключаем страницу 404
    }
    ?>
</div>

<!-- Подключаем правую часть сайта -->
<?php require "views/right-side.php"; ?>