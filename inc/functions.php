<?php
$pdo = new PDO("mysql:host=localhost;dbname=dbtest_mo;charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);