<h3>(+) Crée une tâche ?</h3>
<form method="POST">
    <!-- Utilisateur -->
    <label for="user_id">Utilisateur</label><br>
    <select name="user_id" id="user_id" required>
        <?php foreach($persons as $person): ?>
            <option value="<?=$person["id"]?>"><?= "Utilisateur n°" . $person["id"] . " - " . $person["last_name"] . " " . $person["first_name"] ?></option>
        <?php endforeach;?>
    </select><br><br>

    <!-- Titre -->
    <label for="title">Titre</label><br>
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
<br>

<hr>

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
    <?php
    require_once('../inc/functions.php');
    $sql = "SELECT * FROM tasks";
    $request = $pdo->query($sql);
    while ($row = $request->fetch())
    {
        ?>
            <tr>
                <td><?= $row["task_id"]?></td>
                <td><a href="details_user.php?userid=<?= $row["user_id"] ?>">Uilisateur n°<?= $row["user_id"] ?></a></td>
                <td><?= $row["title"]?></td>
                <td><?= $row["description"]?></td>
                <td><?= $row["task_status"]?></td>
                <td><a href="details_task.php?taskid=<?= $row["task_id"] ?>">Voir les détails</a></td>
            </tr>
        <?php
    }
    ?>
</table>