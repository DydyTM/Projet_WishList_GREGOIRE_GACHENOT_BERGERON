<?php

require_once __DIR__ . '/../app/vendor/autoload.php';

use wishlist\controllers\ControllerList as ControllerList;
use wishlist\controllers\ControllerItem as ControllerItem;
use wishlist\controllers\ControllerUser as ControllerUser;
use wishlist\views\VueIndex as VI;
use wishlist\models\Liste as Liste;

\wishlist\database\Connection::connect();

$app = new \Slim\Slim();

// 1 : Affiche une liste de souhaits
$app->get('/liste/:no', function ($no) {
    $list = new ControllerList();
    $items = $list->afficheListe($no);
    VI::render_with($items);
})->name('afficheListe');


// 2 : Affiche un item d'une liste
$app->get('/items/:id_item', function ($id_item) {
    $itemListe = new ControllerItem();
    $itemListe->afficheItemListe($id_item);
})->name('afficheItemListe');

// 6 : Créer une liste
$app->get('/nouveau/liste', function () {
    $nouvListe = new ControllerList();
    $nouvListe->creeListe();
})->name('creeListe');
$app->post('/nouveau/liste', function () {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $expiration = $_POST['expiration'];

    $l = new Liste();
    $l->titre = $titre;
    $l->description = $description;
    $l->user_id = null;
    $l->expiration = $expiration;
    $l->token = 'nosecure' . $l['$no'];
    $l->save();
})->name('creeListePOST');

// 7 : Modifier les infos générales d'une liste
$app->post('/liste/:id/infos', function ($no) {
    $infListe = new ControllerList();
    $infListe->infosListe($no);
})->name('infosListe');

// 17 : creer un compte
$app->get('/signup', function() {
    $createAccountForm = new ControllerUser();
    $createAccountForm->connexionUser();
});
$app->post('/signup', function() {
    $pseudo = $_POST['pseudo'];
    // A VOIR POUR HASHER LE MOT DE PASSE PARCE QU'EN CLAIR C'EST PAS OUF !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $pass = $_POST['pass'];

    $l = new Utilisateur();
    $l->pseudo($pseudo);
    $l->pass($pass);
    $l->save();
})->name('creerCompte');

// 20 : Rendre une liste publique
$app->post('/liste/:id/publique', function ($no) {
    $listePub = new ControllerList();
    $listePub->listePublique($no);
})->name('listePublique');

// 21 : Afficher les listes de souhaits publique : OK
$app->get('/', function() {
    $affToutesListe = new ControllerList();
    $lists = $affToutesListe->afficheToutesLesListes();
    VI::render_with($lists);
})->name('afficheToutesLesListes');

// 29 : easter egg zrtYes : OK
$app->get('/zrtYes', function() {
    echo '<img src="https://cdn.discordapp.com/emojis/571352374325673995.png?v=1" alt=":zrtYes:">';
});

// 30 : easter egg blob : OK
$app->get('/blob', function() {
    echo  '<img width=512 src="https://raw.githubusercontent.com/Mesabloo/blob/master/assets/icon.png" alt=":blob:"><br>';
    echo '<a href="https://github.com/Mesabloo/blob">https://github.com/Mesabloo/blob</a>';
});

$app->run();

?>

