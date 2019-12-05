<?php

require __DIR__.'/../app/vendor/autoload.php';

$app = new \Slim\Slim();

// 1 : Affiche une liste de souhaits
$app->get('/liste/:id', function ($id) {
    echo "Affiche une liste $id de souhaits";
});

// 2 : Affiche un item d'une liste
$app->get('/liste/:id/items/:id_item', function ($id, $id_item) {
    echo "Affiche un item $id_item d'une liste $id";
});

// 6 : Créer une liste
$app->post('/liste/nouveau', function () {
    echo "Créer une liste";
});

// 7 : Modifier les infos générales d'une liste
$app->post('/liste/:id/infos', function ($id) {
    echo "Modifier les infos générales d'une liste $id";
});

// 20 : Rendre une liste publique
$app->post('/liste/:id/publique', function ($id) {
    echo "Rendre une liste $id publique";
});

// 21 : Afficher les listes de souhaits publique
$app->get('/liste/publique', function() {
    echo "Afficher les listes de souhaits publique";
});

$app->get('/zrtYes', function() {
    echo '<img src="https://cdn.discordapp.com/emojis/571352374325673995.png?v=1" alt=":zrtYes:">';
});

$app->get('/blob', function() {
   echo  '<img width=512 src="https://raw.githubusercontent.com/Mesabloo/blob/master/assets/icon.png" alt=":blob:">';
});

$app->run();

?>