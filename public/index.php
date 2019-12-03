<?php

include '../app/vendor/autoload.php';
use wishlist as WL;

WL\database\Connection::connect();

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
                echo WL\models\pretty\liste\pprint($ls) . '<br/>';
            }  
        ?>
        <br/>
        <h2>Liste des items :</h2>
        <?php
            $i = WL\models\Item::get();
            foreach ($i as $li) {
                echo WL\models\pretty\item\pprint($li) . '<br/>';
            } 

        ?>
        <br/>
        <h2>Item id url :</h2>
        <?php
            foreach ($_GET as $id) {
                $i = WL\models\Item::where('id', '=', $id)->first();
                echo WL\models\pretty\item\pprint($i) . '<br/>';
            }
        ?>
        <br/>
        <h2>Item et liste :</h2>
        <?php
            $lastItem = WL\models\Item::get()->last();
            $a = new WL\models\Item();
            $a->id = $lastItem->id + 1;
            $a->liste_id = 2;
            $a->nom = 'Switch';
            $a->descr = 'Console de chez Nintendo';
            $a->img = 'switch.png';
            $a->url = '';
            $a->tarif = 300;
            $a->save();

            $insert = WL\models\Item::where('id', '=', $a->id)->first();
            echo WL\models\pretty\item\pprint($insert) . '<br/>';
            $a->delete();
        ?>
    </body>
</html>
