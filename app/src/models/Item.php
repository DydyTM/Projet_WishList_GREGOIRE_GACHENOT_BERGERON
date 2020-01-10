<?php

namespace wishlist\models;

use \Illuminate\Database\Eloquent\Model as Model;

class Item extends Model {
    protected $table       = 'item';
    protected $id          = 'id';
    protected $liste_id    = 'liste_id';
    protected $nom         = 'nom';
    protected $descr       = 'descr';
    protected $img         = 'img';
    protected $url         = 'url';
    protected $tarif       = 'tarif';
    protected $participant = 'participant';
    protected $commentaire = 'commentaire';
    public $timestamps     = false;

    public function liste() {
        return self::belongsTo('wishlist\models\Liste', 'liste_id', 'no')->get();
    }
}

?>