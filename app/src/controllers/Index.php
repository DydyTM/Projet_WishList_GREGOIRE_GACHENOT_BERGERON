<?php

namespace wishlist\controllers;

use wishlist\models\Liste as MListe;
use wishlist\views\Index as VIndex;

class Index {
    public function page() {
        $l = MListe::where('publique', '=', 1)->get()->all();
        (new VIndex($l))->afficher();
    }
}

?>