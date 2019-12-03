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
    </body>
</html>
