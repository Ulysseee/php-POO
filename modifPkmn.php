<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMON FIGTHER</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .container {
            width: 65%;
        }
    </style>
</head>
<body>
    <?php

        require 'config.php';
        $manager = new PersonnageManager($db);
        $personnages = $manager->getAllPersonnages();

        // echo '<pre>';
        // var_dump($personnages);<
        // echo '</pre>';
    ?>

    <div class="container">
        <form class="row g-3" action="index.php" method="GET">
            <h1>Modifier un Pokémon :</h1>
            <div class="col-5">
                <label for="" class="form-label">ID du pokémon à modifier :</label>
                <input name="modifId" type="number" min="1" class="form-control" id="inputId4" placeholder="1" required>
            </div>
            <div class="col-7">
                <label class="form-label">Nouveau nom du Pokémon :</label>
                <input name="modifName" type="text" class="form-control" id="inputAddress" placeholder="Bulbizarre, Salamèche, Carapuce..." required>
            </div>
            <div class="col-6">
                <label class="form-label">Nouvelle attaque :</label>
                <input name="modifAtk" type="number" class="form-control" id="inputEmail4" placeholder="10" required>
            </div>
            <div class="col-6">
                <label class="form-label">Nouveaux points de vies :</label>
                <input name="modifPv" type="number" class="form-control" id="inputPassword4" placeholder="50" required>
            </div>
            <div class="col-12">
                <label  class="form-label">Nouvelle image du Pokémon :</label>
                <input name="modifImg" type="text" class="form-control" id="inputAddress" placeholder="https://...">
            </div>
            <div class="col-12 mt-5">
                <button type="submit" class="btn btn-outline-success">Modifier</button>
            </div>
        </form>
    </div>
        
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>