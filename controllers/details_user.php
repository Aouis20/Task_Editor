<?php
// GET parameters
$userid = filter_input(INPUT_GET, "userid", FILTER_VALIDATE_INT);
if(!$userid) {
    http_response_code(404);
    echo "404 BAD REQUEST";
    exit();
};

// PDO
require_once('../inc/functions.php');

// GET user_info
$stmt = $pdo->prepare("
SELECT first_name, last_name
FROM users
WHERE id = :userid
");
$stmt->execute([
    "userid" => $userid
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC); //unique fetch

// GET user_task
$stmt = $pdo->prepare("
SELECT *
FROM users u
JOIN tasks t
	ON u.id = t.user_id
    AND t.user_id = :userid
");
$stmt->execute([
    "userid" => $userid
]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tâche de l'utilisateur</title>
    </head>
    <body>
    <!-- HEADER -->
    <?php require_once('../tpl/header.php') ?>

    <!-- MAIN -->
        <main>
            <!-- user_info -->
            <h1><?= $user["first_name"] . " " . $user["last_name"] . " (n°" . $userid . ")"?></h1>

            <?php if($tasks): ?>
                <!-- user_tasks -->
                <h3>Les tâches sont:</h3>
                <?php foreach($tasks as $task): ?>
                <ul>
                    <li>
                        <u><?=("Tâche n°" . $task["task_id"] . ":")?></u>
                        <strong><?=$task["title"] ?></strong>
                        <em><?= $task["task_status"] ?></em>
                        <span>(<a href="details_task.php?taskid=<?=$task["task_id"]?>">Voir les détails</a>)</span>
                    </li>
                    <p><?= $task["description"]?></p>
                </ul>
                <?php endforeach; ?>
            <?php else: echo "Aucune tâches n'a été assigné, si vous le souhaitez, ajouter une tâche ici bas."?>
            <?php endif; ?>

            <!-- Add task -->
            <?php require_once('create_task.php');?>
        </main>
        <?php require_once('../tpl/footer.php') ?>
    </body>
</html>