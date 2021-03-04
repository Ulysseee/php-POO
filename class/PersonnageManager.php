<?php

    class PersonnageManager {
        private $db;

        public function setDb($db) {
            $this->db=$db;
        }

        public function __construct($db) {
            $this->setDB($db);
        }

        public function getAllPersonnages() {
            $requete = "SELECT * FROM personnages";
            $stmt=$this->db->query($requete);
        
            while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $personnages[] = new Personnage($donnees);
            }
            return $personnages;
        }

        public function getOnePersonageByID($id) {
            $requete = "SELECT * FROM personnages WHERE id=$id";
            $stmt=$this->db->query($requete);
        
            while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $personnage[] = new Personnage($donnees);
            }
            return $personnage;
        }

        public function insertOnePersonage(Personnage $perso) {
            $requete = "INSERT INTO personnages (id, name, atk, pv, img) VALUES (NULL, :name, :atk, :pv, :img)";
            
            $stmt = $this->db->prepare($requete);
            $stmt->bindParam('name', $perso->getName(), PDO::PARAM_STR);
            $stmt->bindParam('atk', $perso->getAtk(), PDO::PARAM_INT);
            $stmt->bindParam('pv', $perso->getPv(), PDO::PARAM_INT);
            $stmt->bindParam('img', $perso->getImg(), PDO::PARAM_STR);
            $stmt->execute();

            $perso->hydrate([
                'id' => $this->db->lastInsertId(),
            ]);

            header('location:index.php?insert=ok');
        }

        public function updateOnePersonnage(Personnage $perso) {
            $requete = "UPDATE personnages SET name = :name, atk = :atk, pv = :pv, img = :img WHERE id = :id";

            $stmt = $this->db->prepare($requete);
            $stmt->bindParam(':id', $perso->getId(), PDO::PARAM_INT);
            $stmt->bindParam(':name', $perso->getName(), PDO::PARAM_STR);
            $stmt->bindParam(':atk', $perso->getAtk(), PDO::PARAM_INT);
            $stmt->bindParam(':pv', $perso->getPv(), PDO::PARAM_INT);
            $stmt->bindParam(':img', $perso->getImg(), PDO::PARAM_STR);
            $stmt->execute();

            header('location:index.php?modif=ok');
        }

        public function update(Personnage $perso) {
            $requete = 'UPDATE personnages SET pv = :pv WHERE id = :id';
            var_dump($requete);

            $stmt = $this->db->prepare($requete);
            var_dump($stmt);
            $stmt->bindParam('pv', $perso->getPv(), PDO::PARAM_INT);
            $stmt->bindParam('id', $perso->getid(), PDO::PARAM_INT);
            
            $stmt->execute();
        }

        public function deleteOnePersonageByID($id) {
            var_dump($id);
            $requete = 'DELETE FROM personnages WHERE id = '.$id.'';
            $stmt = $this->db->prepare($requete);
            $stmt->execute();

            header('location:index.php?delete=ok');
        }
    }
?>