<?php
// GET parameters
$taskid = filter_input(INPUT_GET, "taskid", FILTER_VALIDATE_INT);
if(!$taskid) {
    http_response_code(404);
    echo "404 BAD REQUEST";
    exit();
};

// PDO
require_once('../inc/functions.php');

// GET Task info
$stmt = $pdo->prepare("
SELECT *
FROM tasks
WHERE task_id = :taskid
");
$stmt->execute([
    "taskid" => $taskid
]);
$task = $stmt->fetch(PDO::FETCH_ASSOC); //unique fetch

?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Task</title>
    </head>
    <body>
    <!-- HEADER -->
    <?php require_once('../tpl/header.php') ?>

    <!-- MAIN -->
        <section>
            
            <!-- Task info -->
            <?php if($task): ?>
                <h1>Task n°(<?=$task["task_id"]?>)</h1>
                <ul>
                    <li>Task id:<?=$task["task_id"]?></li>
                    <li>Utilisateur n°<?=$task["user_id"]?></li>
                    <li><?= $task["title"]?></li>
                    <li><?=$task["description"]?></li>
                    <li><?=$task["task_status"]?></li>
                </ul>
            <?php else: echo "Aucune tâches n'a été assigné, si vous le souhaitez, ajouter une tâche ici bas."?>
            <?php endif; ?>
        </section>
        <?php require_once('../tpl/footer.php') ?>
    </body>
</html>