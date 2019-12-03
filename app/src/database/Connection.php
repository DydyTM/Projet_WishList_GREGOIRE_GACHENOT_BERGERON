<?php

namespace wishlist\database;

use Illuminate\Database\Capsule\Manager as DB;

class Connection {
    static function connect() {
        $db = new DB();
        $db->addConnection( ['driver'    => 'mysql',
            'host'      => 'mysql',
            'database'  => 'wishlist',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''] );
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}

?>