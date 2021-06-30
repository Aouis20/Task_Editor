<?php
// POST parameters (add task)
$user_id = filter_input(INPUT_POST, "user_id");
$title = filter_input(INPUT_POST, "title");
$desc = filter_input(INPUT_POST, "desc");
$status = filter_input(INPUT_POST, "status");

if($user_id && $title && $desc && $status) {
    
$stmt = $pdo->prepare("
INSERT INTO tasks (user_id, title, description, task_status) 
VALUES(:user_id, :title, :description, :task_status)
");

$ok = $stmt->execute([
    "user_id" => $user_id,
    "title" => $title,
    "description" => $desc,
    "task_status" => $status,
]);
}