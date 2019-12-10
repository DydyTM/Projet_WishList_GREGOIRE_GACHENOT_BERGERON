<?php

namespace wishlist\views;

use wishlist\templates\IndexTemplate as T;

class VueConnexion {

    public static function render_with($list) {
        echo sprintf(T::generate(), $list);
    }
}

?>
