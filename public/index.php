<?php

require_once __DIR__ . '/../app/vendor/autoload.php';

use wishlist\BDD;
use Slim\Slim;
use wishlist\Chemins;
use wishlist\controllers as cntrls;

session_start();

(new BDD())
    ->initConnexion()
    ->démarrer();

$CSS  = Chemins::$CSS;
$NODE = Chemins::$NODEJS;
$JS   = Chemins::$JS;

$app = new Slim();

// GET routes
$app->get('/login', function () {
    (new cntrls\Profil())->pageConnexion();
})->name('connexion');
$app->get('/signup', function () {
    (new cntrls\Profil())->pageInscription();
})->name('inscription');
$app->get('/liste/:token', function ($token) {
    (new cntrls\Liste())->afficherItems($token);
})->name('affichageListe');
$app->get('/liste/:token/items/:id', function ($token, $id) {
    (new cntrls\Item())->afficherItem($token, $id);
})->name('affichageItem');
$app->get('/nouveau/liste', function () {
    (new cntrls\Liste())->nouvelleListe();
})->name('créerListe');
$app->get('/profil', function () {
    (new cntrls\Profil())->afficherProfil();
})->name('affichageProfil');
$app->get('/liste/:token/infos', function ($token) {
    (new cntrls\Liste())->afficherModifsListe($token);
})->name('modificationInfosListe');
$app->get('/liste/:token/ajouterItem', function ($token) {
    (new cntrls\Liste())->afficherAjoutItem($token);
})->name('ajoutItem');
$app->get('/', function () {
    (new cntrls\Index())->page();
})->name('root');
$app->get('/blob', function () {
    (new cntrls\Blob())->pressF();
})->name('blob');
$app->get('/zrtYes', function () {
    (new cntrls\ZrtYes())->oui();
})->name('zrtYes');

// POST routes
$app->post('/login', function () use ($app) {
    (new cntrls\Profil())->connexion($app->request->post('pseudo'), $app->request->post('checked'));
});
$app->post('/signup', function () use ($app) {
    (new cntrls\Profil())->créerCompte($app->request->post('pseudo'), $app->request->post('pass'));
});
$app->post('/logout', function () {
    (new cntrls\Profil())->déconnecter();
});
$app->post('/nouveau/liste', function () use ($app) {
    (new cntrls\Liste())->créerListe($app->request->post('titre'), $app->request->post('description'), $app->request->post('expiration'), $app->request->post('publique'));
});
$app->post('/liste/:token/infos', function ($token) use ($app) {
    (new cntrls\Liste())->modifierListe($token, $app->request->post('titre'), $app->request->post('description'), $app->request->post('expiration'), $app->request->post('publique'));
});
$app->post('/liste/:token/ajouterItem', function ($token) use ($app) {
    (new cntrls\Item())->ajouterItem($token, $app->request->post('titre'), $app->request->post('description'), $app->request->post('prixItem'), $app->request->post('urlProduit'));
});
$app->post('/liste/:token/items/:id', function ($token, $id) use ($app) {
    (new cntrls\Item())->ajouterParticipant($token, $id, $app->request->post('participant'), $app->request->post('commentaire'));
});
$app->post('/liste/:token/infos/del', function ($token) {
    (new cntrls\Liste())->supprimerListe($token);
});
$app->post('/liste/:token/items/:id/del', function ($token, $id) {
    (new cntrls\Item())->supprimerItem($token, $id);
});

$app->run();

session_register_shutdown();

?>