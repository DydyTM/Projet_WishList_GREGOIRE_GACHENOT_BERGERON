<?php

namespace wishlist\views;

use wishlist\Chemins;

class ListeComplete {
    private $liste;
    private $items;
    private $propriétaire;
    private $commentaires;
    private $expiré;

    public function __construct($l, $items, $proprio, $commentaires, $expir) {
        $this->liste = $l;
        $this->items = $items;
        $this->propriétaire = $proprio;
        $this->commentaires = $commentaires;
        $this->expiré       = $expir;
    }

    public function afficher() {
        $name   = $this->liste['titre'];
        $descr  = $this->liste['description'];
        $exp    = $this->liste['expiration'];
        $tk     = $this->liste['token_visu'];
        $tk_mod = $this->liste['token_modif'];
        $items  = $this->items;
        $pseud  = $this->propriétaire['pseudo'];
        $expir  = $this->expiré;
        $JS     = Chemins::$JS;

        include __DIR__ . '/Header.php';

        echo <<< end
                <h1>$name <h2 align=right>Par $pseud</h2></h1>
                <h3>$descr</h3>
                <button onclick="javascript:partager('$tk', false)">Partager</button>
                end;                
        if(!$expir) {
            if ($pseud === $_SESSION['pseudo']) {
                echo <<< end
                    <button onclick="javascript:partager('$tk_mod', true)">Partager avec droit de modification</button> 
                    <button onclick="modifier('$tk_mod')">Modifier</button>
                end;
            } else {
                echo <<< end
                    <button onclick="ajoutCommentaire('$tk')">Ajouter un commentaire</button>
                end;
            }
        }
                
        echo <<< end
                <h5 align=right>expire : $exp</h5>
                <hr>
                <h3><u>Items : </u></h3><br>
            </div>
        end;

        (new ItemsShort($tk, $items, $pseud, $expir))->afficher();

        echo <<< end
            <hr style="width: 100%;">

            <h3><u>Commentaires : </u></h3><br>
        end;

        foreach ($this->commentaires as $comm) {
            (new CommentaireLarge($comm))->afficher();
        }

        echo <<< end
            <script src="$JS/liste.js"></script>
        end;

        include __DIR__ . '/Footer.php';
    }
}

?>