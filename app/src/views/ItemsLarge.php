<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemsLarge {
    private $items;
    private $token;

    public function __construct($token, $items) {
        $this->token = $token;
        $this->items = $items;
    }

    public function afficher() {
        array_map(function ($id) { (new ItemLarge($id, $this->token))->afficher(); }, $this->items);
    }
}

?>