<?php

namespace wishlist\views;

class ZrtYes {
    public function afficher() {
        include __DIR__ . '/Header.php';
        echo <<< end
            <img src="https://cdn.discordapp.com/emojis/571352374325673995.png?v=1" alt=":zrtYes:">
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>