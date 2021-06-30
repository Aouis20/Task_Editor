<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Suivi des tâches</title>
    </head>
    <body>
        <!-- HEADER -->
        <?php require_once('../tpl/header.php') ?>

        <!-- MAIN -->
        <section>
            <h1>Suivi des tâches</h1>
            <table border=1>
                <tr>
                    <th>Tâche id</th>
                    <th>Utilisateur id</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Etat</th>
                    <th>Détails</th>
                </tr>
                <?php foreach($tasks as $task): ?>
                <tr>
                    <td><?= $task["task_id"] ?></td>
                    <td><a href="voir-user_tasks.php?userid=<?= $task["user_id"] ?>">Uilisateur n°<?= $task["user_id"] ?></a></td>
                    <td><?= $task["title"] ?></td>
                    <td><?= $task["description"] ?></td>
                    <td><?= $task["task_status"] ?></td>
                    <td><?=404?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
        <?php require_once('../tpl/footer.php') ?>
    </body>
</html>