<?php

namespace wishlist\controllers;

use wishlist\views as v;

class Blob {
    // 30 : easter egg blob : OK
    public function pressF() {
        (new v\Blob())->afficher();
    }
}

?>