<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
require __DIR__ . '/controleur/Controleur.php';
require __DIR__ . '/controleur/UtilisateurControleur.php';
require __DIR__ . '/controleur/ConnexionControleur.php';

$controleur = new Controleur();
$conControleur = new ConnexionControleur();
$userControleur = new UtilisateurControleur();
$pageCourante = isset($_GET['page']) && !empty($_GET['page']) ? (int) strip_tags($_GET['page']) : 1;

$action = isset($_GET['action']) ? strtolower($_GET['action']) : null;

switch ($action) {
    case 'article':
        if (!empty($_GET['id'])) {
            $controleur->showArticle($_GET['id']);
        } else {
            echo "erreur : id non défini";
        }
        break;
    case 'categorie':
        if (!empty($_GET['categorie'])) {
            $categorieId = intval($_GET['categorie']);
            $controleur->showArticleByCategorie($categorieId);
        } else {
            echo "erreur : categorie non défini";
        }
        break;
    case 'connexion':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conControleur->login($username, $password);
        } else {
            $conControleur->showConnexion();
        }
        break;
    case 'home':
        $controleur->showAccueil($pageCourante);
        break;
    case 'logout':
        $conControleur->logout();
        break;
    case 'createarticle':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controleur->createArticle($_POST);
        } else {
            $controleur->showCreateArticle();
        }
        break;
    case 'deletearticle':
        if (!empty($_GET['id'])) {
            $controleur->deleteArticle($_GET['id']);
        } else {
            echo "erreur : id non défini";
        }
        break;
    case 'editarticle':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = [
                'id' => $_GET['id'],
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'categorie' => $_POST['categorie'],
                'description' => $_POST['description']
            ];
            $controleur->updateArticle($article);
        } else {
            if (!empty($_GET['id'])) {
                $controleur->showEditArticle($_GET['id']);
            } else {
                echo "erreur : id non défini";
            }
        }
        break;
    case 'utilisateurs':
        $userControleur->showUtilisateurs();
        break;
    case 'createutilisateur':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userControleur->createUtilisateur($_POST);
        } else {
            $userControleur->showCreateUtilisateur();
        }
        break;
    case 'editutilisateur':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $utilisateur = [
                'id' => $_GET['id'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            ];
            $userControleur->updateUtilisateur($utilisateur);
        } else {
            if (!empty($_GET['id'])) {
                $userControleur->showEditUtilisateur($_GET['id']);
            } else {
                echo "erreur : id non défini";
            }
        }
        break;
    case 'deleteutilisateur':
        if (!empty($_GET['id'])) {
            $userControleur->deleteUtilisateur($_GET['id']);
        } else {
            echo "erreur : id non défini";
        }
    case 'generatetoken':
        if (!empty($_GET['id'])) {
            $userControleur->generateToken($_GET['id']);
        } else {
            echo "erreur : id non défini";
        }
        break;
    case 'soap':
        require 'soap_server.php';
        break;
    case 'soapclient':
        require __DIR__ . '/soap_client.php';
        break;
    case 'api':
        require __DIR__ . '/api/articles.php';
        break;
    default:
        $controleur->showAccueil($pageCourante);
        break;
}
