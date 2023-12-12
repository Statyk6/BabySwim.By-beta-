<?php 
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

session_start();

if (isset($_SESSION['user']) && isset($_SESSION['expire']) && $_SESSION['expire'] > time()) {
    // Уничтожение сессии
    session_unset();
    session_destroy();
}

// Перенаправление на главную страницу
header("Location: /"); 

exit();
?>
