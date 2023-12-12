<?php
/* 
    Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
    Developer - Alexandr Kravets
    https://t.me/statyk7
    job.kravets@gmail.com
*/

$request_uri = $_SERVER['REQUEST_URI']; // Получаю запрошенный URL

// Сопоставляю URL и пути к файлам
$routes = [
    // стандартные страницы
    '/' => 'home_page.php',
    '/booking' => 'booking_page.php',
    '/new_reservation' => 'new_reservation_page.php',
    '/contacts' => 'contacts_page.php',
    '/gallery' => 'gallery_page.php',
    '/news' => 'news_page.php',
    '/odoevskogo' => 'odoevskogo_page.php',
    '/prices' => 'prices_page.php',
    '/reviews' => 'reviews_page.php',
    '/standarts' => 'standarts_page.php',
    '/surganova' => 'surganova_page.php',
    '/vacancies' => 'vacancies_page.php',
    '/register' => 'register_page.php',
    // страницы в панели управления
    '/users' => 'manage/users.php',
    '/reservations' => 'manage/reservations.php',
    '/branches' => 'manage/branches.php',
    '/groups' => 'manage/groups.php',
    '/timetables' => 'manage/timetables.php',
    '/costs' => 'manage/costs.php',
    '/seats' => 'manage/seats.php'
];

// Проверяю, существует ли запрошенный маршрут в массиве $routes
if (array_key_exists($request_uri, $routes)) {
    // Включаю соответствующий файл
    include(__DIR__ . '/views/pages/' . $routes[$request_uri]);
} else {
    // Вывожу страницу с ошибкой 404, если маршрут не найден
    header("HTTP/1.0 404 Not Found");
    require "views/pages/404.php"; // Подключаю страницу 404
}
?>