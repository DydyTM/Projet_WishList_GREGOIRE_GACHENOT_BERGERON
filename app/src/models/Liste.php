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
        <div class=\"row\">
            <div class=\"col-l col-md mb\" >
                <a class=\"card border-left-primary shadow h-100 py-2 invisible-link\" href=\"/liste/" . $l['no'] . "\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xm font-weight-bold text-primary text-uppercase mb-1\">Liste #" . $l['no'] . ": " . $l['titre'] . "</div>
                                <div class=\"text-s text-secondary mb-2\">" . $l['description'] . "</div>
                                <div class=\"text-xs mb-3 text-uppercase\">Expire: " . $l['expiration'] . "</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>";

        return $format; 
        //return "Liste #" . $l['no'] . " of user #" . $l['user_id'] . ": " . $l['titre'] . " ; " . $l['description'] . " ; Expires: " . $l['expiration'];
    }

    function pprint_large($l) {
        return "";
    }
}