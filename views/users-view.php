<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Utilisateurs</title>
    </head>
    <body>
        <!-- HEADER -->
        <?php require_once('../tpl/header.php') ?>

        <!-- MAIN -->
        <section>
            <div>
                <h1>Liste des utilisateurs</h1>
            </div>
            <table border=1>
                <tr>
                    <th>Utilisateur id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Détails</th>
                </tr>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?= ucwords(strtolower($user["first_name"])) ?></td>
                    <td><?= strtoupper($user["last_name"]) ?></td>
                    <td><?= $user["email"] ?></td>
                    <td><a href="details_user.php?userid=<?= $user["id"]?>">Voir les détails</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
        <!-- Add user -->
        <?php require_once('create_user.php'); ?>
        <?php require_once('../tpl/footer.php') ?>
    </body>
</html>