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


        // echo '<pre>';
        // var_dump($personnages);
        // echo '</pre>';
    ?>

    <div class="container">
        <form class="row g-3" action="index.php" method="GET">
            <h1>Ajoutez un nouveau Pokémon :</h1>
            <div class="col-12">
                <label class="form-label">Nom du Pokémon :</label>
                <input name="name" type="text" class="form-control" id="inputAddress" placeholder="Bulbizarre, Salamèche, Carapuce..." required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Attaque :</label>
                <input name="atk" type="number" class="form-control" id="inputEmail4" placeholder="10" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Points de vies :</label>
                <input  name="pv" type="number" class="form-control" id="inputPassword4" placeholder="50" required>
            </div>
            <div class="col-12">
                <label class="form-label">Image du Pokémon :</label>
                <input name="img" type="text" class="form-control" id="inputAddress" placeholder="https://...">
            </div>
            <div class="col-12 mt-5">
                <button type="submit" class="btn btn-outline-success">Ajouter !</button>
            </div>
        </form>
    </div>
        
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>