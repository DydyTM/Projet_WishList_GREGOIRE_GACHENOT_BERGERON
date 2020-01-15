<?php


namespace wishlist\views;

use Slim\Slim;

class Createur {
    private $utilisateur;

    public function __construct($u) {
        $this->utilisateur = $u;
    }

    public function afficher() {
        include __DIR__ . '/Header.php';

        echo <<< end
                <h3>Liste des créateurs de liste publique : </h3>
        end;
        array_map(function ($u) { (new ListeCreateur($u))->afficher(); }, $this->utilisateur);

        include __DIR__ . '/Footer.php';
    }
}