<?php

namespace wishlist\models;

class Liste extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'liste';
    protected $primarykey = 'id';
    protected $user_id = 'user_id';
    protected $titre = 'titre';
    protected $description = 'description';
    protected $expiration = 'expiration';
    protected $token = 'token';
    public $timestamps = false;


}
