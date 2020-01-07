<?php

namespace wishlist\views;

use wishlist\Chemins;

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
        $tk_mod = $this->liste['token_modif'];
        $items  = $this->items;
        $pseud  = $this->propriétaire['pseudo'];
        $JS     = Chemins::$JS;

        include __DIR__ . '/Header.php';

        echo <<< end
            <div class=row>
                <h1>$name <h2 align=right>Par $pseud</h2></h1>
                <h3>$descr</h3>
                <button onclick="javascript:partager('$tk', false)">Partager</button>
                <button onclick="javascript:partager('$tk_mod', true)">Partager avec droit de modification</button>
                <button onclick="javascript:ajouterItem('$tk_mod')">Ajouter un item</button>
                <form method=POST id="delliste-form" action="/liste/$tk>
                    <div class="form">
                        <input type=submit value="Supprimer la liste">
                    </div>
                </form>
                <h5 align=right>expire : $exp</h5>
                <hr>
                <h3><u>Items : </u></h3><br>
            </div>
        end;

        (new ItemsShort($tk, $items))->afficher();

        echo <<< end
            <script src="$JS/liste.js"></script>
        end;

        include __DIR__ . '/Footer.php';
    }
}

?>