<?php
namespace wishlist\models\pretty {
    class PrettyItem {
        public static function pprint($i) {
            $img = $i['img'];
            $format = "
                <div class=\"row\">
                <a class=\"invisible-link\" href=\"/liste/" . $i['liste_id'] . "/item/" . $i['id'] . "\">
                    <img class=\"imageObjet\" src=\"/img/$img\" height='70' width='70'> 
                    <div>
                        <div><u>Item #" . $i['id'] . ":  " . $i['nom'] ."</u><br>" . $i['descr'] . "<br> Tarif : ". $i['tarif']. " €" . "</div>
                    </div>
                    </a>
                </div>";

            return $format;
        }
    }
}