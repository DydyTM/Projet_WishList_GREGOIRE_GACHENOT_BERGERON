<?php


namespace wishlist\models {

    class Item extends \Illuminate\Database\Eloquent\Model
    {

    protected $table = 'item';
    protected $id = 'id';
    protected $liste_id = 'liste_id';
    protected $nom = 'nom';
    protected $descr = 'descr';
    protected $img = 'img';
    protected $url = 'url';
    protected $tarif = 'tarif';
    public $timestamps = false;

    function liste() {
        return $this->belongsTo('wishlist\models\Liste', 'liste_id','no');
    }

    }

}

namespace wishlist\models\pretty\item {
    function pprint($i) {
        return "Item #" . $i['liste_id'] . ":" . $i['id'] . ": " . $i['nom'] . " ; " . $i['descr'] . ", " . $i['tarif'] . " €";
    }
}