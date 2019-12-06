<?php

namespace wishlist\controllers;

use wishlist\views\VueParticipant as VueParticipant;
use wishlist\models\Liste as Liste;

class ControllerList {

    public function afficheListe($no){
        $list = Liste::where('no', '=', $no)->first();
        if (!$list) {
            echo "<p>No wishlist found with no '$no'</p>";
            return;
        }
        $view = new VueParticipant($list->items());
        $view->render(2);
    }

    public function creeListe() {
        echo "Créer une liste";
    }

    public function infosListe($no) {
        echo "Modifier les infos générales d'une liste $no";
    }

    public function listePublique($no) {
        echo "Rendre une liste $no publique";
    }

    public function afficheListePublique() {
        echo "Afficher les listes de souhaits publique";
    }

    public function afficheToutesLesListes() {
        $lists = Liste::all();

        $view = new VueParticipant($lists->toArray());
        $view->render(1);
    }
}

?>
