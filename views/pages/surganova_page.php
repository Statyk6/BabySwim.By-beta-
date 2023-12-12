<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */
    $title = "Сурганова 28а";
    require "views/head.php"; // Подключаем главные html теги
    require "views/left-side.php"; // Подключаем левую часть сайта
?>

<!-- ТУТ КОНТЕНТ -->
<div class="flexbox-center">
    <div class="flexbox-center-content-1">
        <button class="button-filials" type="button" onclick="window.location.href = '/surganova'">Сурганова 28а</button>
        <button class="button-filials" type="button" onclick="window.location.href = '/odoevskogo'">Одоевского 10к6</button>
    </div>

    <div class="flexbox-center-content-3">
        <h2>Сурганова</h2>
        <button class="button-admin" type="button" onclick="window.location.href = '/'">На главную</button>
    </div>
</div>

<!-- Подключаем правую часть сайта -->
<?php require "views/right-side.php"; ?>