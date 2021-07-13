<?php
// POST parameters (add task)
$f_name = filter_input(INPUT_POST, "f_name");
$l_name = filter_input(INPUT_POST, "l_name");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

if($f_name && $l_name && $email) {
    var_dump($f_name,$l_name,$email);
    
$stmt = $pdo->prepare("
INSERT INTO users (first_name, last_name, email) 
VALUES(:f_name, :l_name, :email)
");

$stmt->bindValue([
    "f_name" => ucwords(strtolower($f_name)),
    "l_name" => strtoupper($l_name),
    "email" => strtolower($email),
]);

$ok = $stmt->execute();

}

?><h3>(+) Crée un profil ?</h3>
<form method="POST">
    <!-- Prénom -->
    <label for="f_name">Prénom</label><br>
    <input type="text" id="f_name" name="f_name" required/><br><br>

    <!-- Nom -->
    <label for="l_name">Nom</label><br>
    <input type="text" id="l_name" name="l_name" required/><br><br>

    <!-- Email -->
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" required/><br><br>
    
    <input type="submit" value="Créer"/>
</form>