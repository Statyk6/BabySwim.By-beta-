<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */
    $title = "Управление группами";
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
                <h2>Управление группами</h2>
                <p class="alertMsg">
                <b>Важная информация:</b><br>
                1. При нажатии на кнопку удалить, группа удаляется без предупреждения!<br>
                2. После удаления группу нельзя будет восстановить и все связи с ней будут утеряны!<br>
            </p>
            <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style='display:none'>ID</th>
                        <th>Название группы</th>
                        <th>Относится к филиалу</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Запрос к базе данных для получения групп
                $query = "SELECT g.id, b.branch AS branch_name, g.group_name
                          FROM `groups` AS g
                          LEFT JOIN branches AS b ON g.branch_name = b.id";
                $result = $mysqli->query($query);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $branch_name = $row['branch_name'];
                        $group_name = $row['group_name'];

                        echo "<tr>";
                        echo "<td data-label='ID' style='display:none'>$id</td>";
                        echo "<td data-label='Название группы'>$group_name</td>";
                        echo "<td data-label='Относится к филиалу'><a href='/branches'>$branch_name</a></td>";
                        echo "<td data-label='Действия'><button class='button-delete' type='button' onclick=\"window.location.href='/controllers/actionDeleteGroup.php?id=$id'\">Удалить</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            </table>
        </div>
        <p></p>
        <h3>Добавить новую группу</h3>
        <form method="post" action="/controllers/actionAddGroup.php">
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
            <label for="groupName">Название группы:</label>
            <input type="text" name="groupName" id="groupName" required>
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
