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
        return $this->hasMany('wishlist\models\Item', 'liste_id', 'no')->get();
    }

    }
}

namespace wishlist\models\pretty\liste {
    function pprint_small($l) {
        $format = "
        <div class=\"row list\">
            <a class=\"invisible-link\" href=\"/liste/" . $l['no'] . "\">
                <div class=\"col mr-2\">
                    <div>Liste #" . $l['no'] . ": " . $l['titre'] . "</div>
                    <div>" . $l['description'] . "</div>
                    <div>Expire: " . $l['expiration'] . "</div>
                </div>
            </a>
        </div>";

        return $format; 
        //return "Liste #" . $l['no'] . " of user #" . $l['user_id'] . ": " . $l['titre'] . " ; " . $l['description'] . " ; Expires: " . $l['expiration'];
    }

    function pprint_large($l) {
        return "";
    }
}