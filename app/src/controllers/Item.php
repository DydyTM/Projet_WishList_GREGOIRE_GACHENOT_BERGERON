<?php

namespace wishlist\controllers;

use wishlist\models as mdls;
use wishlist\views\ItemLarge;

class Item {
    // 2 : Affiche un item d'une liste
    public function afficherItem($listeToken, $id) {
        $l = mdls\Liste::where('token_visu', '=', $listeToken)->first();
        $i = $l->items()->where('id', '=', $id)->first();
        if ($i) {
            $prop = mdls\Utilisateur::where('user_id', '=', $l['user_id'])->first();
            (new ItemLarge($i, $listeToken, $prop))->afficher();
        } else {
            // TODO: throw 404 error
        }
    }   

    public function ajouterParticipant($listeToken, $id, $participant) {
        $l = mdls\Liste::where('token_visu', '=', $listeToken)->first();
        $i = mdls\Item::where('liste_id', '=', $l['no'])->whereIn('id', [$id]);
        $i->update(['participant' => $participant]);
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