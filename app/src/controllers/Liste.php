<?php

namespace wishlist\controllers;

use wishlist\views as v;
use wishlist\models\Liste as MListe;
use wishlist\models\Item as MItem;
use wishlist\models\Utilisateur;
use wishlist\models\Commentaires;
use wishlist\models\Item;
use Slim\Slim;
use Slim\Http\Response;

class Liste {
    // 1 : Affiche une liste de souhaits
    public function afficherItems($tk) {
        $l    = MListe::where('token_visu', '=', $tk)->first();
        $prop = Utilisateur::where('user_id', '=', $l['user_id'])->first();
        if($l['expiration'] < date('Y-m-d')) {
            $expir = true;
        } else $expir = false;
        if (!$prop)
            $prop = ['pseudo' => 'un inconnu'];
        $cs   = Commentaires::where('liste_id', '=', $l['no'])->get()->all();
        (new v\ListeComplete($l, $l->items()->all(), $prop, $cs, $expir))->afficher();
    }

    // 6 : Créer une liste
    public function créerListe($titre, $description, $expire, $public) {
        $app = Slim::getInstance();

        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->select('user_id')->first();

        $l = new MListe();
        $l->titre = $titre;
        $l->description = $description;
        $l->user_id = $u['user_id'];
        $l->expiration = $expire;
        $l->publique = $public === 'true' ? 1 : 0;
        do {
            $l->token_visu = self::generateToken(25);
            $liste = MListe::where('token_visu', '=', $l->token_visu)->first();
        } while ($liste);
        do {
            $l->token_modif = self::generateToken(25);
            $liste = MListe::where('token_modif', '=', $l->token_modif)->first();
        } while ($liste);
        $l->save();
    }

    private function generateToken($length = 10) {
        $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
    }

    public function nouvelleListe() {
        (new v\ListeNouveau())->afficher();
    }

    public function afficherAjoutItem($tk) {
        $l = MListe::where('token_modif', '=', $tk)->first();
        if (!$l) {
            $app = Slim::getInstance();
            $app->response = new Response('', 404, []);
        } else
            (new v\ItemNouveau($tk))->afficher();
    }

    public function afficherModifsListe($tk) {
        $l = MListe::where('token_modif', '=', $tk)->first();
        $app = Slim::getInstance();

        if (!$l) {
            $app->response = new Response('', 404, []);
            return;
        }
        if (!isset($_SESSION['pseudo'])) {
            $app->response = new Response('', 403, []);
            return;
        }

        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->first();

        if ($l['user_id'] !== $u['user_id']) {
            $app->response = new Response('', 403, []);
            return;
        }
        $i = Item::where('liste_id', '=', $l["no"])->get()->all();
        (new v\ListeInfos($tk, $l, $i, $l['pseudo']))->afficher();
    }

    public function modifierListe($tk, $titre, $descr, $expir, $public) {
        $l = MListe::whereIn('token_modif', [$tk]);
        $l->update(['titre' => $titre, 'description' => $descr, 'expiration' => $expir, 'publique' => $public === 'true' ? 1 : 0]);
    }

    public function supprimerListe($tk) {
        
        $app = Slim::getInstance();
        if (!isset($_SESSION['pseudo'])) {
            $app->response = new Response('', 403, []);
            return;
        }

        $l = MListe::whereIn('token_modif', [$tk]);
        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->select('user_id')->first();
        $p = $l->select('user_id')->first();

        if($u['user_id'] !== $p['user_id']) {
            $app->response = new Response('', 403, []);
            return;
        }

        Item::where('liste_id', '=', $l->first()["no"])->delete();
        $l->delete();
    }

    public function afficherAjoutCommentaire($tk) {
        (new v\CommentaireNouveau($tk))->afficher();
    }

    public function ajouterCommentaire($pseud, $message, $listeToken) {
        $l = MListe::where('token_visu', '=', $listeToken)->first();
        if (!$l) {
            return Slim::getInstance()->response = new Response('', 404, []);
        }

        $c = new Commentaires();
        $c->pseudo = $pseud;
        $c->liste_id = $l['no'];
        $c->commentaire = $message;
        $c->save();
    }

    public function afficherCréateur() {
        $app = Slim::getInstance();
        $l = MListe::where('publique', '=', 1)->get()->all();
        $u = Utilisateur::whereIn('user_id', array_map(function ($list) { return $list['user_id']; }, $l))->get()->all();
        //var_dump($u->toArray());
        (new v\Createur($u))->afficher();
    }
}

?>