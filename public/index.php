<?php

include '../app/vendor/autoload.php';
use wishlist as WL;

WL\Test::connect();

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Main</title>
    </head>
    <body>
        <h2>Liste de souhaits :</h2>
        <?php
            $l = WL\models\Liste::get();
            foreach ($l as $ls) {
                echo $ls . '<br/>';
            }  
        ?>
        <br/>
        <h2>Liste des items :</h2>
        <?php
            $i = WL\models\Item::get();
            foreach ($i as $li) {
                echo $li . '<br/>';
            }
        ?>
        <br/>
        <h2>Item id url :</h2>
        <?php
            foreach ($_GET as $id) {
                echo WL\models\Item::where('id', '=', $id)->first();
            }
        ?>
    </body>
</html>
