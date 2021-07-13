<?php
// PDO
require_once('../inc/functions.php');
$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);