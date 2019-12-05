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
        $html = '<ul>';
        $print_ = function($l) {
            return "<li><p>" . ListePretty\pprint($l) . "</p></li>";
        };

        $html .= array_reduce($this->list, print_);
        $html .= '</ul>';
        return $html;
    }

    private function showListItems() {
        $html = '<ul>';
        $print_ = function($l) {
            return "<li><p>" . ItemPretty\pprint($l) . "</p></li>";
        };

        $html .= array_reduce($this->list, print_);
        $html .= '</ul>';
        return $html;
    }

    private function showItem() {
        return "<p>" . ItemPretty\pprint($this->list[0]) . "</p>";
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
}

?>
