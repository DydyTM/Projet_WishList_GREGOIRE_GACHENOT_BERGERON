<?php

namespace wishlist\controllers;

use wishlist\views\Index as VIndex;

class Index {
    public function page() {
        // TODO: 21 : Afficher les listes de souhaits publiques
        (new VIndex())->afficher();
    }
}

?>