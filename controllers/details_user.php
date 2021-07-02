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

// User list
require_once('../models/get_user_list.php');

// Create Task
require_once('../models/create_task.php');
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tâche de l'utilisateur</title>
        <style>
            #addtask {
                display:none
            }
        </style>
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
                        <span>(-)</span>
                    </li>
                    <p><?= $task["description"]?></p>
                </ul>
                <?php endforeach; ?>
            <?php else: echo "Aucune tâches n'a été assigné, si vous le souhaitez, ajouter une tâche ici bas."?>
            <?php endif; ?>

            <script src="../js/functions.js"></script>


            <!-- PLUS TASK -->
            <h3>(+) Crée une tâche ?</h3>
            <span onclick="open()">Ajouter une tâche</span>

            <!-- AddTask Form -->
            <section id="addtask">
                <form method="POST">
                    <!-- Utilisateur -->
                    <label for="user_id">Utilisateur</label>
                    <select name="user_id" id="user_id" required>
                        <?php foreach($persons as $person): ?>
                            <option value="<?=$person["id"]?>"><?=$person["last_name"] . " " . $person["first_name"]?></option>
                        <?php endforeach;?>
                    </select><br><br>

                    <!-- Titre -->
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" required/><br><br>

                    <!-- Description -->
                    <label for="desc">Description</label><br>
                    <textarea name="desc" id="desc"></textarea><br><br>

                    <!-- Etat -->
                    <label for="status">Etat</label>
                    <select name="status" id="status" required>
                        <option value="A faire">A faire</option>
                        <option value="En cours">En cours</option>
                        <option value="Fait">Fait</option>
                    </select><br><br>
                    
                    <input type="submit" value="Créer"/>
                </form>
            </section>
        </main>
        <?php require_once('../tpl/footer.php') ?>
    </body>
</html>