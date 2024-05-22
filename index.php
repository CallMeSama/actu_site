<?php
require __DIR__ . '\controleur\Controleur.php';
$controler = new Controleur();
var_dump($_GET['action']);
if (!isset($_GET['action'])) {
    $controler->showAccueil();
} else {
    if (strtolower($_GET['action']) == 'article') {
        if (isset($_GET['id'])) {
            $controler->showArticle($_GET['id']);
        } else {
            echo "erreur : id non défini";
        }
    } else if (strtolower($_GET['action']) == 'categorie') {
        if (isset($_GET['categorie'])) {
            $controler->showArticleByCategorie($_GET['categorie']);
        } else {
            echo "erreur : categorie non défini";
        }
    } else {
        $controler->showAccueil();
    }
}
