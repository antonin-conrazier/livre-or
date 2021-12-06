<?php
    require("util.php");

    session_start();

    extract($_SESSION["user"]);

    $db = new mysqli("localhost", "root", "", "livreor");

    $request = "SELECT * FROM commentaires ORDER BY id DESC";
    $query = $db->query($request);
    $result = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Livre d'or</title>
</head>
<body>
    <header>
        <h1>Livre d'or</h1>
        <a href="/livre-or">Retour</a>
    </header>
    <main id="livreor">
        <?php
        foreach ($result as $commentaire) {
            ?>
            <div class="commentaire">
                <div>
                    <span class="date">Posté le <?= $commentaire["date"] ?> par </span>
                    <span class="username"><?= getUsername($db, $commentaire["id_utilisateur"]) ?></span>
                </div>
                <div class="content"><?= $commentaire["commentaire"] ?></div>
            </div>
            <?php
        }
        ?>
        <div class="buttons">
            <?php
                if (isset($_SESSION["user"])) {
                    echo "<a href='commentaire.php'>Poster un commentaire</a>";
                }
            ?>
        </div>
    </main>
</body>
</html>