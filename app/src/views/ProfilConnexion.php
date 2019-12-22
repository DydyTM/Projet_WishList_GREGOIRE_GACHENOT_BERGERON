<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ProfilConnexion {
    public function afficher() {
        self::afficherPageConnexion();
    }

    private static function afficherPageConnexion() {
        $JS    = Chemins::$JS;
        $CSS   = Chemins::$CSS;
        $login = Slim::getInstance()->urlFor('connexion');

        include __DIR__ . '/Header.php';
        echo <<< end
            <form method=POST id="login-form">
                <div class="pageLogin">Page de connexion !</div>
                <div class="form desc">
                    Pseudo :
                </div>
                <div class="form input">
                    <input type=text name=pseudo placeholder="Saisir un pseudo"/>
                </div>
                <div class="form desc">
                    Mot de passe :
                </div>
                <div class="form input">
                    <input type=password name=pass placeholder="Saisir un mot de passe"/>
                </div>
                <div class="form">
                    <input type=submit value="OK">
                </div>
            </form>

            <script src="$JS/profil.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>