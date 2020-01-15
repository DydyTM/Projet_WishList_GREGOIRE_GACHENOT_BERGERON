<?php

namespace wishlist\controllers;

use Slim\Http\Response;
use wishlist\models as mdls;
use wishlist\models\Utilisateur;
use wishlist\models\Liste as MListe;
use wishlist\views\ItemLarge;
use Slim\Slim;

class Item {
    // 2 : Affiche un item d'une liste
    public function afficherItem($listeToken, $id) {
        $l = mdls\Liste::where('token_visu', '=', $listeToken)->first();
        if (!$l)
            return Slim::getInstance()->response = new Response('', 404, []);

        $i = $l->items()->where('id', '=', $id)->first();
        if($l['expiration'] < date('Y-m-d')) {
            $expir = true;
        } else $expir = false;
        if ($i) {
            $prop = mdls\Utilisateur::where('user_id', '=', $l['user_id'])->first();
            if (!$prop)
                return Slim::getInstance()->response = new Response('', 404, []);

            (new ItemLarge($i, $listeToken, $prop, $expir))->afficher();
        } else {
            Slim::getInstance()->response = new Response('', 404, []);
        }
    }

    public function afficherItemModifs($listeToken, $id) {
        $l = mdls\Liste::where('token_modif', '=', $listeToken)->first();
        if (!$l)
            return Slim::getInstance()->response = new Response('', 404, []);

        $i = $l->items()->where('id', '=', $id)->first();
        if ($i) {
            $prop = mdls\Utilisateur::where('user_id', '=', $l['user_id'])->first();
            if (!$prop)
                return Slim::getInstance()->response = new Response('', 404, []);

            (new ItemLarge($i, $listeToken, $prop, false))->afficher();
        } else {
            Slim::getInstance()->response = new Response($id, 404, []);
        }
    }

    public function ajouterParticipant($listeToken, $id, $participant, $commentaire) {
        $l = mdls\Liste::where('token_visu', '=', $listeToken)->first();
        if (!$l)
            return Slim::getInstance()->response = new Response('', 404, []);

        $i = mdls\Item::where('liste_id', '=', $l['no'])->whereIn('id', [$id]);
        if (!$i)
            return Slim::getInstance()->response = new Response('', 404, []);

        $i->update(['participant' => filter_var($participant, FILTER_SANITIZE_SPECIAL_CHARS)]);
        $i->update(['commentaire' => filter_var($commentaire, FILTER_SANITIZE_SPECIAL_CHARS)]);
        $_SESSION['particip'] = filter_var($participant, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function ajouterItem($token, $titre, $description, $prix, $url) {
        $liste_id = mdls\Liste::where('token_modif', '=', $token)->select('no')->first();
        if (!$liste_id)
            return Slim::getInstance()->response = new Response('', 404, []);
        $liste_id = $liste_id['no'];

        if (empty($titre) || empty($description) || empty($prix))
            return Slim::getInstance()->response = new Response('', 400, []);

        $i = new mdls\Item();
        $i->nom = filter_var($titre, FILTER_SANITIZE_SPECIAL_CHARS);
        $i->descr = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
        $i->tarif = filter_var($prix, FILTER_SANITIZE_NUMBER_INT);
        $i->liste_id = $liste_id;
        $i->url = filter_var($url, FILTER_SANITIZE_SPECIAL_CHARS);
        $i->img = '';
        $i->save();
    }

    public function modifierItem($token, $id, $nom, $descr, $prix, $url) {
        $app = Slim::getInstance();
        $l = mdls\Liste::where('token_visu', '=', $token);
        if(!$l){
            return $app->response = new Response('', 404, []);
        }

        $i = mdls\Item::whereIn('id', [$id]);
        if (!$i)
            return $app->response = new Response('', 404, []);

        if (empty($nom) || empty($descr) || empty($prix))
            return $app->response = new Response('', 400, []);

        $i->update(['nom' => filter_var($nom, FILTER_SANITIZE_SPECIAL_CHARS)
                   , 'descr' => filter_var($descr, FILTER_SANITIZE_SPECIAL_CHARS)
                   , 'tarif' => filter_var($prix, FILTER_SANITIZE_NUMBER_INT)
                   , 'url' => filter_var($url, FILTER_SANITIZE_SPECIAL_CHARS)]);
    }

    public function supprimerItem($token, $id) {
        $app = Slim::getInstance();
        if (!isset($_SESSION['pseudo'])) {
            $app->response = new Response('', 403, []);
            return;
        }

        $p = MListe::where('token_visu','=' , $token)->select('user_id')->first();
        if (!$p)
            return $app->response = new Response('', 404, []);

        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->select('user_id')->first();
        if (!$u)
            return $app->response = new Response('', 404, []);

        if($u['user_id'] !== $p['user_id']) {
            return $app->response = new Response('', 403, []);
        }

        $i = mdls\Item::where('id','=' , $id)->first();
        if (!$i)
            return $app->response = new Response('', 404, []);

        $i->delete();
    }
}

?>