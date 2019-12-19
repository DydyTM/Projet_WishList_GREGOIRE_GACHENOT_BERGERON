<?php

namespace wishlist\models {
    class Liste extends \Illuminate\Database\Eloquent\Model {

        protected $table = 'liste';
        protected $no = 'no';
        protected $user_id = 'user_id';
        protected $titre = 'titre';
        protected $description = 'description';
        protected $expiration = 'expiration';
        protected $token_visu = 'token_visu';
        protected $token_modif = 'token_modif';
        public $timestamps = false;

        function items() {
            return $this->hasMany('wishlist\models\Item', 'liste_id', 'no')->get();
        }

    }
}