<?php

namespace wishlist\controllers;

use wishlist\views\ZrtYes as VZrtYes;

class ZrtYes {
    // 29 : easter egg zrtYes : OK
    public function oui() {
        (new VZrtYes())->afficher();
    }
}

?>