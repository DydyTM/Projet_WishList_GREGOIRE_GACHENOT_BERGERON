<?php

namespace wishlist\models;

class Commentaires extends \Illuminate\Database\Eloquent\Model {
    private $table       = 'commentaires';
    private $id          = 'id';
    private $liste_id    = 'liste_id';
    private $commentaire = 'commentaire';
    private $user_id     = 'user_id';
    public $timestamps   = false;

    public function liste() {
        return self::belongsTo('wishlist\models\Liste', 'liste_id', 'liste_id')->get();
    }

    public function utilisateur() {
        return self::belongsTo('wishlist\models\Utilisateur', 'user_id', 'user_id')->get();
    }
}

?>