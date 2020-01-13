<?php

namespace wishlist\models;

class Commentaires extends \Illuminate\Database\Eloquent\Model {
    protected $table       = 'commentaires';
    protected $id          = 'id';
    protected $liste_id    = 'liste_id';
    protected $commentaire = 'commentaire';
    protected $pseudo      = 'pseudo';
    public $timestamps     = false;

    public function liste() {
        return self::belongsTo('wishlist\models\Liste', 'liste_id', 'liste_id')->get();
    }

    public function utilisateur() {
        return self::belongsTo('wishlist\models\Utilisateur', 'pseudo', 'pseudo')->get();
    }
}

?>