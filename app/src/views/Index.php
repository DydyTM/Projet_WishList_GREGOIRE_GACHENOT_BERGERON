<?php

namespace wishlist\views;

use wishlist\views\ListeLarge as vLL;

class Index {

    private $liste;

    public function __construct($liste) {
        $this->liste = $liste;
    }

    public function afficher() {
        include __DIR__ . '/Header.php';
        foreach($this->liste as $liste){
            (new vLL($liste))->afficher();
        }
        include __DIR__ . '/Footer.php';
    }
}

?>