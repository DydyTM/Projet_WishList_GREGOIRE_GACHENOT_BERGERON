<?php

namespace wishlist\models;

use \Illuminate\Database\Eloquent\Model as Model;

class Utilisateur extends Model {
    protected $table   = 'utilisateur';
    protected $user_id = 'user_id';
    protected $pseudo  = 'pseudo';
    protected $pass    = 'pass';
    public $timestamps = false;

    public function listes() {
        return self::hasMany('wishlist\models\Liste', 'user_id', 'user_id')->get();
    }
}

?>