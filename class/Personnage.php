<?php

    class Personnage {
        private $name;
        private $atk;
        private $pv;
        private $img;
        private $id;
        const MAXLIFE = 200;
        private static $compteur = 0;


        public function getId () {
            return $this->id;
        }

        public function setId (int $id) {
            $this->id=$id;
        }

        public function getPv () {
            return $this->pv;
        }

        public function setPv (int $pv) {
            $this->pv=$pv;
            if ($pv < 0) {
                $this->pv=0;
            }
            if ($pv > self::MAXLIFE) {
                $this->pv=self::MAXLIFE;
            }
        }

        public function getAtk () {
            return $this->atk;
        }

        public function setAtk (int $atk) {
            $this->atk=$atk;
        }

        public function getName () {
            return $this->name;
        }

        public function setName (string $name) {
            $this->name=$name;
        }

        public function getImg () {
            return $this->img;
        }

        public function setImg (string $img) {
            $this->img=$img;
        }

        public function hydrate(array $donnees) {
            foreach ($donnees as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }




        public function __construct (array $donnees) {
            self::$compteur++;

            return $this->hydrate($donnees);
        } 

        public function regenerer($x) {
            $this->pv += $x;
        }

        public function is_alive () {
            return $this->pv > 0;
        }

        public function attaque (Personnage $perso) {
            $perso->pv -= $this->atk;
        }

        public function reinitPv() {
            $this->setPv(self::MAXLIFE);
        }

        public static function getCompteur() {
            return self::$compteur;
        }
    }

?>