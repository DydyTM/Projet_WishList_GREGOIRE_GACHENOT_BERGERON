<?php

namespace wishlist\controllers;

use wishlist\models as mdls;
use wishlist\views\ItemShort;

class Item {
    // 2 : Affiche un item d'une liste
    public function afficherItem($listeToken, $id) {
        $i = mdls\Liste::where('token_visu', '=', $listeToken)->first()->items()->where('id', '=', $id)->first();
        if ($i)
            (new ItemShort($i, $listeToken))->afficher();
        else {
            // TODO: throw 404 error
        }
    }

    public function ajouterItem($token, $titre, $description, $prix) {
        $liste_id = mdls\Liste::where('token_modif', '=', $token)->select('no')->first()['no'];
        $i = new mdls\Item();
        $i->nom = $titre;
        $i->descr = $description;
        $i->tarif = $prix;
        $i->liste_id = $liste_id;
        $i->url = '';
        $i->img = '';
        $i->save();
    }
}

?>