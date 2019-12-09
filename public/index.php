<?php

require __DIR__ . '/../app/vendor/autoload.php';

use wishlist\controllers\ControllerList as ControllerList;
use wishlist\controllers\ControllerItem as ControllerItem;
use wishlist\views\VueIndex as VI;

\wishlist\database\Connection::connect();

$app = new \Slim\Slim();

// 1 : Affiche une liste de souhaits
$app->get('/liste/:no', function ($no) {
    $list = new ControllerList();
    $list->afficheListe($no);
})->name('afficheListe');


// 2 : Affiche un item d'une liste
$app->get('/items/:id_item', function ($id_item) {
    $itemListe = new ControllerItem();
    $itemListe->afficheItemListe($id_item);
})->name('afficheItemListe');

// 6 : Créer une liste
$app->post('/liste/nouveau', function () {
    $nouvListe = new ControllerList();
    $nouvListe->creeListe();
})->name('creeListe');

// 7 : Modifier les infos générales d'une liste
$app->post('/liste/:id/infos', function ($no) {
    $infListe = new ControllerList();
    $infListe->infosListe($no);
})->name('infosListe');

// 20 : Rendre une liste publique
$app->post('/liste/:id/publique', function ($no) {
    $listePub = new ControllerList();
    $listePub->listePublique($no);
})->name('listePublique');

// 21 : Afficher les listes de souhaits publique
$app->get('/liste/publique', function() {
    $affListePub = new ControllerList();
    $affListePub->afficheListePublique();
})->name('afficheListePublique');

$app->get('/zrtYes', function() {
    echo '<img src="https://cdn.discordapp.com/emojis/571352374325673995.png?v=1" alt=":zrtYes:">';
});

$app->get('/blob', function() {
    echo  '<img width=512 src="https://raw.githubusercontent.com/Mesabloo/blob/master/assets/icon.png" alt=":blob:">';
});

$lists = 'hello';
// Afficher toutes les listes
$app->get('/', function() {
    $affToutesListe = new ControllerList();
    $lists = $affToutesListe->afficheToutesLesListes();
    VI::render_with($lists);
})->name('afficheToutesLesListes');

$app->run();

?>

