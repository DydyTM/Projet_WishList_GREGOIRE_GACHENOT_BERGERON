<?php

namespace wishlist\controllers;

use wishlist\models\Liste as MListe;
use wishlist\views\Index as VIndex;

class Index {
    public function page() {
        $l = MListe::where('publique', '=', 1)->where('expiration', '>', date('Y-m-d H:i'))->orderBy('expiration', 'asc')->get()->all();
        (new VIndex($l))->afficher();
    }
}

?>