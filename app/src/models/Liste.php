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
    function pprint_small($l) {
        $format = "
        <div class=\"row\">
            <div class=\"col-l col-md mb\">
                <div class=\"card border-left-primary shadow h-100 py-2\">
                    <div class=\"card-body\">
                    <div class=\"row no-gutters align-items-center\">
                        <div class=\"col mr-2\">
                            <div class=\"text-m font-weight-bold text-primary text-uppercase mb-1\"><u>Liste #" . $l['no'] . ": " . $l['titre'] . "</u><br>" . $l['description'] . "</div>
                        </div>
                        <div class=\"col-auto\">
                            <img class=\"flecheDroite\" src=\"https://www.stickpng.com/assets/images/580b57fcd9996e24bc43c44e.png\" height=\"40\" width=\"40\" alt=\"\"
                                onclick=\"window.location.href='/liste/" . $l['no'] . "'\">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>";

        return $format; 
        //return "Liste #" . $l['no'] . " of user #" . $l['user_id'] . ": " . $l['titre'] . " ; " . $l['description'] . " ; Expires: " . $l['expiration'];
    }

    function pprint_large($l) {
        return "";
    }
}