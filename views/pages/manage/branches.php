<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */
    $title = "Управление филиалами";
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
                <h2>Управление филиалами</h2>
                <p class="alertMsg">
                <b>Важная информация:</b><br>
                1. При нажатии на кнопку удалить, филиал удаляется без предупреждения!<br>
                2. После удаления филиал нельзя будет восстановить и все связи с данным филиалом будут утеряны!<br>
            </p>
            <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style='display:none'>ID</th>
                        <th>Название филиала</th>
                        <th>Адрес филиала</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Запрос к базе данных для получения пользователей
                $query = "SELECT * FROM branches";
                $result = $mysqli->query($query);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $branch = $row['branch'];
                        $adress = $row['adress'];

                        echo "<tr>";
                        echo "<td data-label='ID' style='display:none'>$id</td>";
                        echo "<td data-label='Название филиала'>$branch</td>";
                        echo "<td data-label='Адрес филиала'>$adress</td>";
                        echo "<td data-label='Действия'><button class='button-delete' type='button' onclick=\"window.location.href='/controllers/actionDeleteBranch.php?id=$id'\">Удалить</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            </table>
        </div>
        <p></p>
        <h3>Добавить новый филиал</h3>
            <form method="post" action="/controllers/actionAddBranch.php">
                <label for="branchName">Название филиала:</label>
                <input type="text" name="branchName" id="branchName" required><br>
                <label for="branchAddress">Адрес филиала:</label>
                <input type="text" name="branchAddress" id="branchAddress" required><br>
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