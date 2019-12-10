<?php

namespace wishlist\views;

use wishlist\models\pretty\item as ItemPretty;

class VueItem {
    private $list;

    public function __construct($list) {
        $this->list = $list;
    }

    private function showItem() {
        return ItemPretty\pprint($this->list[0]);
    }

    private function showListItems() {
        $print_ = function($acc, $l) {
            return $acc . ItemPretty\pprint($l);
        };

        $html = array_reduce($this->list, $print_, '');
        return $html;
    }

    public function render($mode) {
        switch ($mode) {
            case 2:
                echo $this->showListItems();
                break;
            case 3:
                echo $this->showItem();
                break;
            default:
                echo "<h1>Unknwon mode $mode</h1>";
        }
    }

    public function to_string($mode) {
        switch ($mode) {
            case 2:
                return $this->showListItems();
            case 3:
                return $this->showItem();
            default:
                return "<h1>Unknwon mode $mode</h1>";
        }
    }
}