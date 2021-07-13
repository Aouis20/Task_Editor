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
                    <a href="details_user.php?userid=<?= $task["user_id"]?>"><h3>Utilisateur n°<?=$task["user_id"]?></h3></a>
                    <li><strong><?= $task["title"]?></strong></li>
                    <li><?=$task["description"]?></li>
                    <li><em><?=$task["task_status"]?></em></li>
                </ul>
            <?php else: echo "La tâche que vous recherchez n'existe pas."?>
            <?php endif; ?>
        </section>
        <?php require_once('../tpl/footer.php') ?>
    </body>
</html>