<?php


namespace wishlist\controllers;

use wishlist\views\VueItem as VueItem;
use wishlist\views\VueListe as VueListe;
use wishlist\models\Liste as Liste;
use wishlist\views\VueIndex as VI;
use wishlist\templates\ListeTemplate as LT;
use wishlist\templates\ItemTemplate as IT;

class ControllerList
{

    public function afficheListe($token)
    {
        $list = Liste::where('token_visu', '=', $token)->first();
        if (!$list) {
            echo "<p>No wishlist found with no '$token'</p>";
            return;
        }
        $view = new VueItem($list->items()->toArray());
        return $view->to_string(2);
    }

    public function creeListe()
    {
        VI::render_with(LT::generateNew());
    }

    public function infosListe($token)
    {
        echo "Modifier les infos générales d'une liste $token";
    }

    public function listePublique($token)
    {
        echo "Rendre une liste $token publique";
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