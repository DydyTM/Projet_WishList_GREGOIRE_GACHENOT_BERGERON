<?php

namespace wishlist\templates;

class ListeTemplate extends Template {
    public static function generateNew() {
        return "
            <form action=liste method=POST>
                <input type=text name=titre />
                <input type=text name=description />
                <input type=date name=expiration />
                <input type=submit value=OK>
            </form>
        ";
    }
}

?>