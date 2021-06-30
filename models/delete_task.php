<?php
$task_id = filter_input(INPUT_GET, "taskid", FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("
DELETE FROM tasks
WHERE task_id = :task_id
");
$stmt->execute([
    "task_id" => $task_id
]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);