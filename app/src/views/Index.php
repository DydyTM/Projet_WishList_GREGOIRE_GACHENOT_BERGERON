<?php

namespace wishlist\views;

use Slim\Slim;
use wishlist\views\ListeLarge as vLL;

class Index {

    private $liste;

    public function __construct($liste) {
        $this->liste = $liste;
    }

    public function afficher() {
        $nliste = Slim::getInstance()->urlFor('créerListe');
        include __DIR__ . '/Header.php';
        if($_SESSION['pseudo'] == null) {
            echo <<< end
                <form action='$nliste' method='GET'>
                    <input type=submit value='Créer une nouvelle liste'/>
                </form>
            end;
        }
        foreach($this->liste as $liste){
            (new vLL($liste))->afficher();
        }
        include __DIR__ . '/Footer.php';
    }
}

?>