<?php

include '../app/vendor/autoload.php';
$me = new App\PHP();

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Main</title>
    </head>
    <body>
        <h1>Hello from <?php echo $me->getName(); ?></h1>
    </body>
</html>
