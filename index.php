<?php
require __DIR__ . '\controleur\Controleur.php';
$controler = new Controleur();
$pageCourante;

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $pageCourante = (int) strip_tags($_GET['page']);
} else {
    $pageCourante = 1;
}

if (!isset($_GET['action'])) {
    $controler->showAccueil($pageCourante);
} else {
    if (strtolower($_GET['action']) == 'article') {
        if (isset($_GET['id'])) {
            $controler->showArticle($_GET['id']);
        } else {
            echo "erreur : id non défini";
        }
    } else if (strtolower($_GET['action']) == 'categorie') {
        if (isset($_GET['categorie'])) {
            $categorieId = intval($_GET['categorie']);
            $controler->showArticleByCategorie($categorieId);
        } else {
            echo "erreur : categorie non défini";
        }
    } else if (strtolower($_GET['action']) == 'connexion') {
        $controler->showConnexion();
    } else {
        $controler->showAccueil($pageCourante);
    }
}
