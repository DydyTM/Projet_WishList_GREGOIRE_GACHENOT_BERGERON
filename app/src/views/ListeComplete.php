<?php

namespace wishlist\views;

class ListeComplete {
    private $liste;
    private $items;
    private $propriétaire;

    public function __construct($l, $items, $proprio) {
        $this->liste = $l;
        $this->items = $items;
        $this->propriétaire = $proprio;
    }

    public function afficher() {
        $name   = $this->liste['titre'];
        $descr  = $this->liste['description'];
        $exp    = $this->liste['expiration'];
        $tk     = $this->liste['token_visu'];
        $items  = $this->items;
        $pseudo = $this->proprio['pseudo'];

        include __DIR__ . '/Header.php';

        echo <<< end
            <div class=row>
                <h1>$name <h2 align=right>Par $pseudo</h2></h1>
                <h3>$descr</h3>
                <h5 align=right>expire : $exp</h5>
                <hr>
                <h3><u>Items : </u></h3><br>
            </div>
        end;

        (new ItemsLarge($tk, $items))->afficher();

        include __DIR__ . '/Footer.php';
    }
}

?>