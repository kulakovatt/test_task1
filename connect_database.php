<?php
/**
    Подключение к БД.
    Скрипт создания БД прикреплён.
 */

    session_start();
    $host = "localhost";
    $database = "test";
    $user = "root";
    $password = "";

    $_SESSION["link"] = mysqli_connect($host, $user, $password, $database) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $_SESSION["link"]->set_charset('utf8');

?>