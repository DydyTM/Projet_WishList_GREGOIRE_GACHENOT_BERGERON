<?php

namespace wishlist\database;

use Illuminate\Database\Capsule\Manager as DB;

class Connection {
    static function connect() {
        $db = new DB();
        $db->addConnection(parse_ini_file("../app/src/config/conf.ini"));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}

?>