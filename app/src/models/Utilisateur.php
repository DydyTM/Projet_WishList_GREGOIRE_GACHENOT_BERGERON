<?php

namespace wishlist\models;

class Utilisateur extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'utilisateur';
    protected $user_id = 'user_id';
    protected $pseudo = 'pseudo';
    protected $pass = 'pass';
    public $timestamps = false;
}

?>