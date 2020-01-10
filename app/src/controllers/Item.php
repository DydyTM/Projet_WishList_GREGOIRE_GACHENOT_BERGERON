<?php

namespace wishlist\controllers;

use Slim\Http\Response;
use wishlist\models as mdls;
use wishlist\models\Liste as MListe;
use wishlist\models\Utilisateur;
use wishlist\views\ItemLarge;
use Slim\Slim;

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

    public function ajouterParticipant($listeToken, $id, $participant, $commentaire) {
        $l = mdls\Liste::where('token_visu', '=', $listeToken)->first();
        $i = mdls\Item::where('liste_id', '=', $l['no'])->whereIn('id', [$id]);
        $i->update(['participant' => $participant]);
        $i->update(['commentaire' => $commentaire]);
        $_SESSION['particip'] = $participant;
    }

    public function ajouterItem($token, $titre, $description, $prix, $url) {
        $liste_id = mdls\Liste::where('token_modif', '=', $token)->select('no')->first()['no'];
        $i = new mdls\Item();
        $i->nom = $titre;
        $i->descr = $description;
        $i->tarif = $prix;
        $i->liste_id = $liste_id;
        $i->url = $url;
        $i->img = '';
        $i->save();
    }

    public function supprimerItem($token, $id) {

        $app = Slim::getInstance();
        if (!isset($_SESSION['pseudo'])) {
            $app->response = new Response('', 403, []);
            return;
        }

        $p = MListe::where('token_visu','=' , $token)->select('user_id')->first();
        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->select('user_id')->first();

        if($u['user_id'] !== $p['user_id']) {
            $app->response = new Response('', 403, []);
            return;
        }

        mdls\Item::where('id','=' , $id)->first()->delete();

    }
}

?>