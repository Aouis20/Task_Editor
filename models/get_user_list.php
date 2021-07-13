<?php
$stmt = $pdo->prepare("
SELECT *
FROM users
ORDER BY id
");
$stmt->execute();
$persons = $stmt->fetchAll(PDO::FETCH_ASSOC);