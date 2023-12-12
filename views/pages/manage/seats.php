<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/
$title = "Управление местами";
require "views/head.php"; // Подключаем главные html теги
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
            <h2>Управление местами</h2>
            <p class="alertMsg">
                <b>Важная информация:</b><br>
                1. При нажатии на кнопку удалить, места для группы удаляются без предупреждения!<br>
                2. После удаления мест их нельзя будет восстановить и все связи будут утеряны!<br>
            </p>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style='display:none'>ID</th>
                            <th>Группа</th>
                            <th>Кол-во мест</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Запрос к базе данных для получения расписания
                        $query = "SELECT t.id, t.group_name, g.count_seats
                            FROM `groups` AS t
                            INNER JOIN `seats` AS g ON t.id = g.group_name";
                        $result = $mysqli->query($query);

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $group_name = $row['group_name'];
                                $count_seats = $row['count_seats'];

                                echo "<tr>";
                                echo "<td data-label='ID' style='display:none'>$id</td>";
                                echo "<td data-label='Группа'>$group_name</td>";
                                echo "<td data-label='Кол-во мест'>$count_seats</td>";
                                echo "<td data-label='Действия'><button class='button-delete' type='button' onclick=\"window.location.href='/controllers/actionDeleteSeats.php?id=$id'\">Удалить</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <p></p>
            <h3>Добавить места в группу</h3>
            <form method="post" action="/controllers/actionAddSeats.php">
                <label for="groupId">Выберите группу:</label>
                <select name="groupId" id="groupId" required>
                <option value=""></option>
                <?php
                $sql = "SELECT id, group_name FROM `groups`";
                    // Выполнение запроса
                    $result = $mysqli->query($sql);

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            // Добавление вариантов выбора в выпадающий список
                            echo "<option value='" . $row['id'] . "'>" . $row['group_name'] . "</option>";
                        }
                    }
                ?>
                </select>
                <br>
                <label for="count_seats">Количество мест:</label>
                    <input type="number" name="count_seats" id="count_seats" min="1" max="25" required>
                    <br>
                <button type="submit" class="button-submit">Добавить</button>
            </form>
            <p></p>
        </div>
    <?php
    } else {
        require "views/pages/404.php"; // Подключаем страницу 404
    }
    ?>
</div>

<!-- Подключаем правую часть сайта -->
<?php require "views/right-side.php"; ?>
