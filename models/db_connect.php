<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */

    $mysqli = new mysqli("localhost", "root", "MSAncNI(B5ujnVzX", "babyswim"); // Подключение к базе данных

    // Проверка на ошибку подключения
    if ($mysqli->connect_error) {
        die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
    }