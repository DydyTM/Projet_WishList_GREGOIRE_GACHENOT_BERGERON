<?php


namespace wishlist\views;


class ListeCreateur {
    private $utilisateur;

    public function __construct($u) {
        $this->utilisateur = $u;
    }

    public function afficher() {
        $util = $this->utilisateur['pseudo'];
            echo <<< end
                <p>$util</p>
            end;
    }
}