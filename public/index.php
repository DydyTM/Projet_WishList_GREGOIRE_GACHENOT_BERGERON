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

// 17 : Créer un compte
$app->get('/signup', function () {
    (new cntrls\Profil())->pageInscription();
})->name('inscription');

// 18 : S'authentifier
$app->get('/login', function () {
    (new cntrls\Profil())->pageConnexion();
})->name('connexion');

// 1 : Afficher une liste de souhaits
$app->get('/liste/:token', function ($token) {
    (new cntrls\Liste())->afficherItems($token);
})->name('affichageListe');

// 2 : Afficher un item d'une liste
$app->get('/liste/:token/items/:id', function ($token, $id) {
    (new cntrls\Item())->afficherItem($token, $id);
})->name('affichageItem');

// 9 : Modifier un item
$app->get('/liste/:token/items/:id/infos', function ($token, $id) {
    (new cntrls\Item())->afficherItemModifs($token, $id);
})->name('affichageModifItem');

// 6 : Créer une liste
$app->get('/nouveau/liste', function () {
    (new cntrls\Liste())->nouvelleListe();
})->name('créerListe');

// 1 : Afficher une liste de souhaits (Toutes les listes d'un utilisateur)
$app->get('/profil', function () {
    (new cntrls\Profil())->afficherProfil();
})->name('affichageProfil');

// 7 : Modifier les informations générales d'une de ses listes
$app->get('/liste/:token/infos', function ($token) {
    (new cntrls\Liste())->afficherModifsListe($token);
})->name('modificationInfosListe');

// 8 : Ajouter des items
$app->get('/liste/:token/ajouterItem', function ($token) {
    (new cntrls\Liste())->afficherAjoutItem($token);
})->name('ajoutItem');

// 5 : Ajouter un message sur une liste
$app->get('/liste/:token/ajoutCommentaire', function  ($token) {
    (new cntrls\Liste())->afficherAjoutCommentaire($token);
})->name('ajoutCommentaire');

// 21 : Afficher les listes de souhaits publiques
$app->get('/', function () {
    (new cntrls\Index())->page();
})->name('root');

// EASTER EGGS
$app->get('/blob', function () {
    (new cntrls\Blob())->pressF();
})->name('blob');
$app->get('/zrtYes', function () {
    (new cntrls\ZrtYes())->oui();
})->name('zrtYes');

// POST routes

// 17 : Créer un compte et 18 : S'authentifier
$app->post('/login', function () use ($app) {
    (new cntrls\Profil())->connexion($app->request->post('pseudo'), $app->request->post('checked'));
});
$app->post('/signup', function () use ($app) {
    (new cntrls\Profil())->créerCompte($app->request->post('pseudo'), $app->request->post('pass'));
});
$app->post('/logout', function () {
    (new cntrls\Profil())->déconnecter();
});


// 6 : Créer une liste
$app->post('/nouveau/liste', function () use ($app) {
    (new cntrls\Liste())->créerListe($app->request->post('titre'), $app->request->post('description'), $app->request->post('expiration'), $app->request->post('publique'));
});

// 7 : Modifier les informations générales d'une de ses listes
$app->post('/liste/:token/infos', function ($token) use ($app) {
    (new cntrls\Liste())->modifierListe($token, $app->request->post('titre'), $app->request->post('description'), $app->request->post('expiration'), $app->request->post('publique'));
});

// 8 : Ajouter des items
$app->post('/liste/:token/ajouterItem', function ($token) use ($app) {
    (new cntrls\Item())->ajouterItem($token, $app->request->post('titre'), $app->request->post('description'), $app->request->post('prixItem'), $app->request->post('urlProduit'));
});

// 9 : Modifier un item
$app->post('/liste/:token/items/:id/infos', function($token, $id) use ($app) {
    (new cntrls\Item())->modifierItem($token, $id, $app->request->post('nom'), $app->request->post('descr'), $app->request->post('tarif'), $app->request->post('url'));
});

// 3 : Réserver un item et 4 : Ajouter un message avec sa réservation
$app->post('/liste/:token/items/:id', function ($token, $id) use ($app) {
    (new cntrls\Item())->ajouterParticipant($token, $id, $app->request->post('participant'), $app->request->post('commentaire'));
});
$app->post('/liste/:token/infos/del', function ($token) {
    (new cntrls\Liste())->supprimerListe($token);
});

// 10 : Supprimer un item
$app->post('/liste/:token/items/:id/del', function ($token, $id) {
    (new cntrls\Item())->supprimerItem($token, $id);
});

// 5 : Ajouter un message sur une liste
$app->post('/liste/:token/ajoutCommentaire', function ($token) use ($app) {
    (new cntrls\Liste())->ajouterCommentaire($app->request->post('pseudo'), $app->request->post('message'), $token);
});

// 14 : Partager une liste (voir la fonction partager() dans liste.js)

// 20 : Rendre une liste publique (voir le formulaire de modification de la liste dans ListeInfos.php)

$app->run();

session_register_shutdown();

?>