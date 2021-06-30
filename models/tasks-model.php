<?php
// PDO
require_once('../inc/functions.php');
$stmt = $pdo->prepare("SELECT * FROM tasks");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);