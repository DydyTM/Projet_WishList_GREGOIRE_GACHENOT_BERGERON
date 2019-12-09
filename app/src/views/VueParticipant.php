<?php

namespace wishlist\views;

use wishlist\models\pretty\liste as ListePretty;
use wishlist\models\pretty\item as ItemPretty;

class VueParticipant {
    private $list;

    public function __construct($list) {
        $this->list = $list;
    }

    private function showListLists() {
        $print_ = function($acc, $l) {
            return $acc . ListePretty\pprint_small($l);
        };

        $html = array_reduce($this->list, $print_, "");
        return $html;
    }

    private function showListItems() {
        $print_ = function($acc, $l) {
            return $acc . ItemPretty\pprint_large($l);
        };

        $html = array_reduce($this->list, $print_, '');
        return $html;
    }

    private function showItem() {
        return ItemPretty\pprint($this->list[0]);
    }

    public function render($mode) {
        switch ($mode) {
            case 1:
                echo $this->showListLists();
                break;
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
            case 1:
                return $this->showListLists();
            case 2:
                return $this->showListItems();
            case 3:
                return $this->showItem();
            default:
                return "<h1>Unknwon mode $mode</h1>";
        }
    }
}

?>
