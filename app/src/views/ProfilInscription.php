<?php

namespace wishlist\views;

use wishlist\Chemins;

class ProfilInscription {
    public function afficher() {
        self::afficherPageInscription();
    }

    private static function afficherPageInscription() {
        $JS     = Chemins::$JS;

        include __DIR__ . '/Header.php';
        echo <<< end
            <form method=POST id="signup-form">
                <div class="pageLogin">Page d'inscription !</div>
                <div class="form desc">
                    Saisir un pseudo :
                </div>
                <div class="form input">
                    <input type=text name=pseudo placeholder="Pseudo"/>
                </div>
                <div class="form desc">
                    Saisir un mot de passe :
                </div>
                <div class="form input">
                    <input type=password name=pass placeholder="Mot de passe"/>
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