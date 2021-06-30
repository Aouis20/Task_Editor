<?php
$stmt = $pdo->prepare("
SELECT *
FROM users
ORDER BY last_name
");
$stmt->execute();
$persons = $stmt->fetchAll(PDO::FETCH_ASSOC);