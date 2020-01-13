<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemsShort {
    private $items;
    private $token;
    private $pseud;

    public function __construct($token, $items, $pseud) {
        $this->token = $token;
        $this->items = $items;
        $this->pseud = $pseud;
    }

    public function afficher() {
        array_map(function ($id) { (new ItemShort($id, $this->token, $this->pseud))->afficher(); }, $this->items);
    }
}

?>