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
        <h1>Hello, World!</h1>
        <?php
            $l = WL\models\Liste::get();
            foreach ($l as $i) {
                echo $i . '<br/>';
            }  
        ?>
    </body>
</html>
