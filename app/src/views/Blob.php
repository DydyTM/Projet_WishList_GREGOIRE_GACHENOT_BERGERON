<?php

namespace wishlist\views;

class Blob {
    public function afficher() {
        include __DIR__ . '/Header.php';
        echo <<< end
            <img width=256 src="https://raw.githubusercontent.com/Mesabloo/nihil/2b573be5822ef9e6ee68d359f9a36155c95aaff0/assets/icon.png" alt=":blob:"><br>

            <span>
                Ci-gît Blob, ancien nom de <a href="https://github.com/mesabloo/nihil">Nihil</a>, devenu meme de S3.<br>
                Il sera à tout jamais dans nos mémoires.
            </span>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>