<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMON FIGTHER</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <?php

        require 'config.php';
        $manager = new PersonnageManager($db);

        $personnages = $manager->getAllPersonnages();
        $test = ["test", 1, 1, "oui"];

        if (isset($_GET['name']) && isset($_GET['atk']) && isset($_GET['pv']) && isset($_GET['img'])) {
            $perso = new Personnage([
                'name' => $_GET['name'],
                'atk' => $_GET['atk'],
                'pv' => $_GET['pv'],
                'img' => $_GET['img'],
            ]);

            echo '<pre>';
            var_dump($perso);
            echo '</pre>';


            $manager->insertOnePersonage($perso);
        }

        if (isset($_GET['modifId']) && ($_GET['modifName']) && isset($_GET['modifAtk']) && isset($_GET['modifPv']) && isset($_GET['modifImg'])) {
            $perso = new Personnage([
                'name' => $_GET['modifName'],
                'atk' => $_GET['modifAtk'],
                'pv' => $_GET['modifPv'],
                'img' => $_GET['modifImg'],
                'id' => $_GET['modifId']
            ]);

            echo '<pre>';
            var_dump($perso);
            echo '<pre>';

            $manager->updateOnePersonnage($perso);
        }            
    ?>

    <div class="container">
        <?php 
            if (isset($_GET['insert'])) {
                echo '
                    <div class="alert alert-success" role="alert">
                        Votre Pokémon a bien été ajouté !
                    </div>
                ';
            } else if (isset($_GET['supp'])) {
                $id = (int)$_GET['supp'];
                $manager->deleteOnePersonageByID($id);
            } else if (isset($_GET['delete'])){
                echo '
                    <div class="alert alert-success" role="alert">
                        Votre Pokémon a bien été supprimé !
                    </div>
                ';
            } else if (isset($_GET['modif'])) {
                echo '
                    <div class="alert alert-success" role="alert">
                        Votre Pokémon a bien été modifié !
                    </div>
                ';
            } else if (isset($_GET['pkmnAtk'])) {
                $pkmnAtk1 = $manager->getOnePersonageByID($_GET['attaquant1']);
                $pkmnAtk2 = $manager->getOnePersonageByID($_GET['attaquant2']);
                if ($pkmnAtk1[0]->is_alive() && $pkmnAtk2[0]->is_alive()) {
                    $pkmnAtk1[0]->attaque($pkmnAtk2[0]);
                    $pkmnAtk2[0]->attaque($pkmnAtk1[0]);  
                    
                    $manager->update($pkmnAtk2[0]);
                    $manager->update($pkmnAtk1[0]);
                }  

                if (!$pkmnAtk1[0]->is_alive()) {
                    $manager->deleteOnePersonageByID($pkmnAtk1[0]->getId());
                } else if (!$pkmnAtk2[0]->is_alive()) {
                    $manager->deleteOnePersonageByID($pkmnAtk2[0]->getId());
                } 
                
                header('location:index.php?atk=done');
            } else if(isset($_GET['atk'])) {
                echo '
                <div class="alert alert-primary" role="alert">
                    Attaque effectuée avec succès ! Vous pouvez renvoyez 2 Pokémons se combattre.
                </div>
                ';
            }
        ?>
        
        <?php
            echo "<p>Vous avez <strong>" . Personnage::getCompteur() . "</strong> Pokémons disponibles dans le PC.</p>";
        ?>
        <p>Envoyez 2 pokémons <strong>différents</strong> à combattre :</p>
        <form class="row" action="index.php" method="GET">
            <div class="col-4">
                <select name="attaquant1" class="form-select" required>
                    <option value="">Pokémon 1</option>
                    <?php
                        if (isset($_GET['pkmnReady'])) {
                            $pkmnReady = $manager->getOnePersonageByID($_GET['attaquant1']);
                            echo '<option value="'.$pkmnReady[0]->getId().'">'.$pkmnReady[0]->getName().'</option>';
                        } else {
                            foreach ($personnages as $pokemon) {
                                echo '<option value="'.$pokemon->getId().'">'.$pokemon->getName().'</option>';
                            }
                        }

                    ?>
                </select>
            </div>
            <?php  
                if (isset($_GET['pkmnReady']) || isset($_GET['pkmnAtk'])) {
                    echo ('
                        <div class="col-4">
                            <button name="pkmnAtk" type="submit" class="btn btn-success col-12">Combattre !</button>
                        </div>
                    ');
                } else {
                    echo ('
                        <div class="col-4">
                            <button name="pkmnReady" type="submit" class="btn btn-warning col-12">Envoyer</button>
                        </div>
                    ');
                }
            ?>
            <div class="col-4">
                <select name="attaquant2" class="form-select" required>
                    <option value="">Pokémon 2</option>
                    <?php
                        if (isset($_GET['pkmnReady'])) {
                            $pkmnReady = $manager->getOnePersonageByID($_GET['attaquant2']);
                            echo '<option value="'.$pkmnReady[0]->getId().'">'.$pkmnReady[0]->getName().'</option>';
                        } else {
                            foreach ($personnages as $pokemon) {
                                echo '<option value="'.$pokemon->getId().'">'.$pokemon->getName().'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row m">
            <div class="col-6 d-flex justify-content-center">
                    <?php
                        if (isset($_GET['attaquant1']) && isset($_GET['pkmnReady'])) {
                            $pkmnReady = $manager->getOnePersonageByID($_GET['attaquant1']);
                            var_dump($pkmnReady[0]->getId());
                            
                                
                            echo ('<img src="'.$pkmnReady[0]->getImg().'" alt="">');
                        }
                    ?>
            </div>
            <div class="col-6 d-flex justify-content-center">
                    <?php
                        if (isset($_GET['attaquant2']) && isset($_GET['pkmnReady'])) {
                            $pkmnReady = $manager->getOnePersonageByID($_GET['attaquant2']);
                            var_dump($pkmnReady[0]->getId());
                            
                                
                            echo ('<img src="'.$pkmnReady[0]->getImg().'" alt="">');
                        }
                    ?>
            </div>
        </div>
        <table class="table caption-top">
            <caption>Liste des Pokémons dans le PC.</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Attaque</th>
                        <th scope="col">PV</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            // var_dump($personnages);
                            foreach($personnages as $pokemon){
                                echo '<tr><th id="Pkmn-'.$pokemon->getId().'" Pkmn-Id="'.$pokemon->getId().'">'.$pokemon->getId().'</th><td>'.$pokemon->getName().'</td><td>'.$pokemon->getAtk().'</td><td>'.$pokemon->getPv().'</td>';
                                echo '<td><button idPkmnBtn="'.$pokemon->getId().' type="button" class="btn btn-danger supp">Executer</button></td><tr>';
                            };
                        ?>
                    
                </tbody>
        </table>

        <button type="button" class="btn btn-primary mt-3"><a href="addPkmn.php">Ajouter un Pokémon</a></button><button type="button" class="btn btn-outline-primary mt-3 ms-3"><a href="modifPkmn.php">Modifier un Pokémon</a></button>


        <?php
            // echo '<pre>';
            // var_dump($personnages);
            // echo '</pre>';
        ?>
    </div>


        

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="assets/app.js"></script>
</body>
</html>