<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/
$title = "Управление расписанием";
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
            <h2>Управление расписанием</h2>
            <p class="alertMsg">
                <b>Важная информация:</b><br>
                1. При нажатии на кнопку удалить, расписание удаляется без предупреждения!<br>
                2. После удаления расписания его нельзя будет восстановить и все связи будут утеряны!<br>
            </p>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style='display:none'>ID</th>
                            <th>Филиал</th>
                            <th>Группа</th>
                            <th>День недели</th>
                            <th>Время начала</th>
                            <th>Время завершения</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Запрос к базе данных для получения расписания
                        $query = "SELECT t.id, b.branch AS branch_name, g.group_name, t.day, t.time_start, t.time_end
                            FROM `timetables` AS t
                            LEFT JOIN `branches` AS b ON t.branch_name = b.id
                            LEFT JOIN `groups` AS g ON t.group_name = g.id";
                        $result = $mysqli->query($query);

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $branch_name = $row['branch_name'];
                                $group_name = $row['group_name'];
                                $day = $row['day'];
                                $time_start = $row['time_start'];
                                $time_end = $row['time_end'];

                                echo "<tr>";
                                echo "<td data-label='ID' style='display:none'>$id</td>";
                                echo "<td data-label='Филиал'>$branch_name</td>";
                                echo "<td data-label='Группа'>$group_name</td>";
                                echo "<td data-label='День'>$day</td>";
                                echo "<td data-label='Время начала'>$time_start</td>";
                                echo "<td data-label='Время завершения'>$time_end</td>";
                                echo "<td data-label='Действия'><button class='button-delete' type='button' onclick=\"window.location.href='/controllers/actionDeleteTime.php?id=$id'\">Удалить</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <p></p>
            <h3>Добавить новое расписание</h3>
            <form method="post" action="/controllers/actionAddTime.php">
                <label for="branchId">Выберите филиал:</label>
                <select name="branchId" id="branchId" required>
                <option value=""></option>
                    <?php
                    // Запрос к базе данных для получения списка филиалов
                    $branchesQuery = "SELECT * FROM branches";
                    $branchesResult = $mysqli->query($branchesQuery);

                    if ($branchesResult) {
                        while ($branchRow = $branchesResult->fetch_assoc()) {
                            $branchId = $branchRow['id'];
                            $branchName = $branchRow['branch'];

                            echo "<option value='$branchId'>$branchName</option>";
                        }
                    }
                    ?>
                </select>
                <br>
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
                <label for="dayOfWeek">Выберите день недели:</label>
                <select name="dayOfWeek" id="dayOfWeek" required>
                    <option value=""></option>
                    <option value="Понедельник">Понедельник</option>
                    <option value="Вторник">Вторник</option>
                    <option value="Среда">Среда</option>
                    <option value="Четверг">Четверг</option>
                    <option value="Пятница">Пятница</option>
                    <option value="Суббота">Суббота</option>
                    <option value="Воскресенье">Воскресенье</option>
                </select>
                <br>
                <label for="time">Время начала и завершения:</label>
                    <input class="input_time" type="time" id="time_start" name="time_start"/>
                    <input class="input_time" type="time" id="time_end" name="time_end"/>
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
