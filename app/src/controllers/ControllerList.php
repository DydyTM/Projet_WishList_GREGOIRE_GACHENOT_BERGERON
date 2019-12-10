<?php


namespace wishlist\controllers;

use wishlist\views\VueItem as VueItem;
use wishlist\views\VueListe as VueListe;
use wishlist\models\Liste as Liste;
use wishlist\views\VueIndex as VI;
use wishlist\templates\ListeTemplate as LT;

class ControllerList
{

    public function afficheListe($no)
    {
        $list = Liste::where('no', '=', $no)->first();
        if (!$list) {
            echo "<p>No wishlist found with no '$no'</p>";
            return;
        }
        $view = new VueItem($list->items()->toArray());
        return $view->to_string(2);
    }

    public function creeListe()
    {
        VI::render_with(LT::generateNew());
    }

    public function infosListe($no)
    {
        echo "Modifier les infos générales d'une liste $no";
    }

    public function listePublique($no)
    {
        echo "Rendre une liste $no publique";
    }

    public function afficheListePublique()
    {
        echo "Afficher les listes de souhaits publique";
    }

    public function afficheToutesLesListes()
    {
        $lists = Liste::orderBy('expiration')->get();

        $view = new VueListe($lists->toArray());
        return $view->to_string(1);
    }
}


