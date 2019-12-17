<?php

namespace wishlist\views;

use wishlist\models\pretty\PrettyListe as ListePretty;

class VueListe {
    private $list;

    public function __construct($list) {
        $this->list = $list;
    }

    private function showListLists() {
        $print_ = function($acc, $l) {
            return $acc . ListePretty::pprint_small($l);
        };

        $html = array_reduce($this->list, $print_, "");
        return $html;
    }

        public function render($mode) {
        switch ($mode) {
            case 1:
                echo $this->showListLists();
                break;
            default:
                echo "<h1>Unknwon mode $mode</h1>";
        }
    }

    public function to_string($mode) {
        switch ($mode) {
            case 1:
                return $this->showListLists();
            default:
                return "<h1>Unknwon mode $mode</h1>";
        }
    }
}
