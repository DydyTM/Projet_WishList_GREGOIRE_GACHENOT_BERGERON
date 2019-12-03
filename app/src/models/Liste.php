<?php

namespace wishlist\models {
    class Liste extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'liste';
    protected $id = 'id';
    protected $user_id = 'user_id';
    protected $titre = 'titre';
    protected $description = 'description';
    protected $expiration = 'expiration';
    protected $token = 'token';
    public $timestamps = false;


    }
}

namespace wishlist\models\pretty\liste {
    function pprint($l) {
        return "Liste #" . $l['no'] . " of user #" . $l['user_id'] . ": " . $l['titre'] . " ; " . $l['description'] . " ; Expires: " . $l['expiration'];
    }
}