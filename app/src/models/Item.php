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
        $img = $i['img'];
        $format = "
        <div class=\"row\">
            <div class=\"col-l col-md mb\">
                <div class=\"card border-left-primary shadow h-100 py-2\">
                    <div class=\"card-body\">
                    <div class=\"row no-gutters align-items-center\">
                        <img class=\"imageObjet\" src=\"/img/$img\" height='70' width='70'> 
                        <div class=\"col mr-2\">
                            <div class=\"text-m font-weight-bold text-primary text-uppercase mb-1\"><u>Item #" . $i['id'] . ":  " . $i['nom'] ."</u><br>" . $i['descr'] . "<br> Tarif : ". $i['tarif']. " €" . "</div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>";

        return $format;
    }
}