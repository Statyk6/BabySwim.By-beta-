<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */
    $title = "Управление стоимостью";
    require "views/head.php"; // Подключаем главные html теги
    require "views/left-side.php"; // Подключаем левую часть сайта
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
                <h2>Управление стоимостью</h2>
            </div>
        <?php
        } else {
            require "views/pages/404.php"; // Подключаем страницу 404
        }
        ?>
    </div>
    
<!-- Подключаем правую часть сайта -->
<?php require "views/right-side.php"; ?>