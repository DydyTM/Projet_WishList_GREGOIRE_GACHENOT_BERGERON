<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemsShort {
    private $items;
    private $token;
    private $pseud;
    private $expiré;

    public function __construct($token, $items, $pseud, $expir) {
        $this->token  = $token;
        $this->items  = $items;
        $this->pseud  = $pseud;
        $this->expiré = $expir;
    }

    public function afficher() {
        array_map(function ($id) { (new ItemShort($id, $this->token, $this->pseud, $this->expiré))->afficher(); }, $this->items);
    }
}

?>