<h3>(+) Crée une tâche ?</h3>
<form method="POST">
    <!-- Utilisateur -->
    <label for="user_id">Utilisateur</label><br>
    <select name="user_id" id="user_id" required>
        <?php foreach($persons as $person): ?>
            <option value="<?=$person["id"]?>"><?=$person["last_name"] . " " . $person["first_name"]?></option>
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