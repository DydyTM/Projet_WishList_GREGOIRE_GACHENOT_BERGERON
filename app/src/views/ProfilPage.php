<?php

namespace wishlist\views;

use Slim\Slim;

class ProfilPage {
    private $profil;
    private $listes;

    public function __construct($profil, $listes) {
        $this->profil = $profil;
        $this->listes = $listes;
    }

    public function afficher() {
        $pseudo = $_SESSION['pseudo'];
        $profil = Slim::getInstance()->urlFor('affichageProfil');
        $nliste = Slim::getInstance()->urlFor('créerListe');

        include __DIR__ . '/Header.php';
        echo <<< end
            Page de profil de <a href='$profil'>$pseudo</a> !<br>
            <hr>
            <form action='$nliste' method='GET'>
                <input type=submit value='Créer une nouvelle liste'/>
            </form>
        end;
        array_map(function ($l) { (new ListeLarge($l))->afficher(); }, $this->listes);
        include __DIR__ . '/Footer.php';
    }
}

?>