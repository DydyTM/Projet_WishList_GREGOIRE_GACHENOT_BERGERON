<?php
namespace wishlist\models\pretty {
    class PrettyListe {
        public static function pprint_small($l) {
            $format = "
            <div class=\"row list\">
                <a class=\"invisible-link\" href=\"/liste/" . $l['token_visu'] . "\">
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

        public static function pprint_large($l) {
            return "";
        }
    }
}