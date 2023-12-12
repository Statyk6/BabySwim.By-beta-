<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */
    $title = "Управление бронированиями";
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
        <h2>Управление бронированиями</h2>
        <p class="alertMsg">
            <b>Важная информация:</b><br>
            1. При нажатии на кнопку удалить, бронь удаляется без предупреждения!<br>
            2. После удаления брони нельзя восстановить и клиенту придется заново бронировать место!<br>
            3. При нажатии на кнопку отменить, статус брони меняется на 'отменена'.<br>
        </p>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style='display:none'>ID</th>
                        <th>Филиал</th>
                        <th>Группа</th>
                        <th>Место</th>
                        <th>Время</th>
                        <th>Клиент</th>
                        <th>Телефон</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Запрос к базе данных для получения бронирований с объединением таблиц reservations и groups
                $query = "SELECT r.id, b.branch AS branch, g.group_name, r.position, r.time, r.name, r.phone, r.status
                          FROM reservations AS r
                           LEFT JOIN branches AS b ON r.id = b.id
                          LEFT JOIN `groups` AS g ON r.group_id = g.id";
                $result = $mysqli->query($query);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $branch = $row['branch'];
                        $group_name = $row['group_name'];
                        $position = $row['position'];
                        $time = $row['time'];
                        $name = $row['name'];
                        $phone = $row['phone'];
                        $status = $row['status'];

                        $statusColor = ($status == 'Отменена') ? 'red' : (($status == 'Активна') ? 'green' : 'black');

                        echo "<tr>";
                        echo "<td data-label='ID' style='display:none'>$id</td>";
                        echo "<td data-label='Филиал'><a href='/branches'>$branch</a></td>";
                        echo "<td data-label='Группа'><a href='/groups'>$group_name</a></td>";
                        echo "<td data-label='Место'>$position</td>";
                        echo "<td data-label='Время'>$time</td>";
                        echo "<td data-label='Клиент'><a href='/users'>$name</a></td>";
                        echo "<td data-label='Телефон'>$phone</td>";
                        echo "<td data-label='Статус' style='color: $statusColor; font-weight: 500;'>$status</td>";
                        echo "<td data-label='Действия'><button class='button-cancel' type='button' onclick=\"window.location.href='/controllers/actionCancelReserv.php?id=$id'\">Отменить</button>
                        <button class='button-delete' type='button' onclick=\"window.location.href='/controllers/actionDeleteReserv.php?id=$id'\">Удалить</button></td>";
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
