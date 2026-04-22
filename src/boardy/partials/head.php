<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);

if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boardy — <?= $page_title ?? 'Доска объявлений' ?></title>
    <link rel="stylesheet" href="/css/style.css?v=10">
</head>
<body>
