<?php

namespace wishlist\models {
    class Liste extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'liste';
    protected $no = 'no';
    protected $user_id = 'user_id';
    protected $titre = 'titre';
    protected $description = 'description';
    protected $expiration = 'expiration';
    protected $token = 'token';
    public $timestamps = false;

   function items() {
        return $this->hasMany('wishlist\models\Item', 'liste_id', 'no');
    }

    }
}

namespace wishlist\models\pretty\liste {
    function pprint($l) {
        return "Liste #" . $l['no'] . " of user #" . $l['user_id'] . ": " . $l['titre'] . " ; " . $l['description'] . " ; Expires: " . $l['expiration'];
    }
}