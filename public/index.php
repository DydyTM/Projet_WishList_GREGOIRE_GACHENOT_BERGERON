<?php

require_once __DIR__ . '/../app/vendor/autoload.php';

use wishlist\controllers\ControllerList as ControllerList;
use wishlist\controllers\ControllerItem as ControllerItem;
use wishlist\controllers\ControllerUser as ControllerUser;
use wishlist\views\VueIndex as VI;
use wishlist\models\Liste as Liste;
use wishlist\models\Utilisateur as Utilisateur;

\wishlist\database\Connection::connect();

$app = new \Slim\Slim();

// 1 : Affiche une liste de souhaits
$app->get('/liste/:no', function ($no) {
    $list = new ControllerList();
    $items = $list->afficheListe($no);
    VI::render_with($items);
})->name('afficheListe');


// 2 : Affiche un item d'une liste
$app->get('/liste/:no/item/:id', function ($no, $id) {
    $itemListe = new ControllerItem();
    $item = $itemListe->afficheItemListe($no, $id);
    VI::render_with($item);
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

    $generateToken = function($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    };

    $l = new Liste();
    $l->titre = $titre;
    $l->description = $description;
    $l->user_id = null;
    $l->expiration = $expiration;
    $liste = 1;
    while ($liste) {
        $l->token_visu = $generateToken(25);
        $liste = Liste::where('token_visu', '=', $l->token_visu)->first();
    }
    $liste = 1;
    while ($liste) {
        $l->token_modif = $generateToken(25);
        $liste = Liste::where('token_modif', '=', $l->token_modif)->first();
    }
    $l->save();
    header('Refresh:0; url=/');
})->name('creeListePOST');

// 7 : Modifier les infos générales d'une liste
$app->post('/liste/:id/infos', function ($no) {
    $infListe = new ControllerList();
    $infListe->infosListe($no);
})->name('infosListe');

//8 : Ajout d'item dans une liste
$app->post('/liste/:token/ajouterItem', function ($token) {
   $ajoutItem = new ControllerList();
   $ajoutItem->ajouterItem($token);
})->name('ajouterItem');

// 17 : creer un compte : OK
$app->get('/signup', function() {
    $createAccountForm = new ControllerUser();
    $createAccountForm->inscriptionUser();
});
$app->post('/signup', function() {
    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];

    $l = new Utilisateur();
    $l->pseudo = $pseudo;
    $l->pass = $pass;
    $l->save();

    setcookie('user_connected', 'yes', 0, "/");
    setcookie('pseudo', $pseudo, 0, '/');

    header("Refresh:0; url=/");
})->name('creerCompte');

$app->post('/logout', function() {
    unset($_COOKIE['pseudo']);
    setcookie('pseudo', null, 1);
    unset($_COOKIE['user_connected']);
    setcookie('user_connected', null, 1);
});

$app->get('/login', function() {
   $connectAccountForm = new ControllerUser();
   $connectAccountForm->connexionUser();
});
$app->post('/login', function() {
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['pass'];
    $u = Utilisateur::where('pseudo', '=', $pseudo)->get();
    if($u->count() != 0) {
        $u = $u->first();
        if(password_verify($mdp, $u['pass'])) {
            setcookie('user_connected', 'yes', 0, "/");
            setcookie('pseudo', $pseudo, 0, '/');
            header("Refresh:0; url=/");
        } else {
            //AJOUT ALERT MDP NON CONNU DANS LA BDD
            header("Refresh:0; url=/login");
        }
    } else {
        header("Refresh:0; url=/login");
    }
});

$app->get('/profil', function() {
   $affProfil = new ControllerUser();
   $affProfil->pageProfil();
});

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

