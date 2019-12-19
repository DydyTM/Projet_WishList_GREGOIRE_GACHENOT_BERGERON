<?php
namespace wishlist\models\pretty {
    use wishlist\models\Liste as Liste;
    class PrettyItem {
        public static function pprint($i) {
            $token = Liste::select('token_visu')->where('no', '=', $i['liste_id'])->first();
            $img = $i['img'];
            $format = "
                <div class=\"row\">
                <a class=\"invisible-link\" href=\"/liste/" . $token["token_visu"] . "/item/" . $i['id'] . "\">
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