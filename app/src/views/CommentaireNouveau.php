<?php

namespace wishlist\views;

use wishlist\Chemins;

class CommentaireNouveau {
    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function afficher() {
        $JS    = Chemins::$JS;
        $pseud = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '';
        $tk    = $this->token;

        include __DIR__ . '/Header.php';
        echo <<< end
            <form method=POST id='newcomm-form' token="$tk">
                <div class="nouvelleListe">Nouveau commentaire !</div>
                <div class="form desc">
                    Pseudo :
                </div>
                <div class="form input">
                    <input type=text name=pseudo placeholder="Pseudo" value="$pseud">
                </div>
                <div class="form desc">
                    Message :
                </div>
                <div class="form input">
                    <textarea name=message placeholder="Mon super message"></textarea>
                </div>
                <div class="form">
                    <input type=submit value="OK">
                </div>
            </form>

            <script src="$JS/liste.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>