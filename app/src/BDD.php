<?php

namespace wishlist;

use Illuminate\Database\Capsule\Manager as DB;

class BDD {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function initConnexion() {
        $this->db->addConnection(parse_ini_file(__DIR__ . "/config/conf.ini"));
        return $this;
    }

    public function démarrer() {
        $this->db->setAsGlobal();
        $this->db->bootEloquent();
        return $this;
    }
}

?>