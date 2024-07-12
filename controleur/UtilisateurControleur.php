<?php
require_once dirname(__DIR__) . '\modele\dao\UtilisateurDao.php';
require_once dirname(__DIR__) . '\modele\dao\TokenDao.php';
require_once dirname(__DIR__) . '\modele\dao\CategorieDao.php';

class UtilisateurControleur
{
    private $utilisateurDao;
    private $categorieDao;
    private $tokenDao;

    public function __construct()
    {
        $this->utilisateurDao = new UtilisateurDao();
        $this->categorieDao = new CategorieDao();
        $this->tokenDao = new TokenDao();
    }

    public function showUtilisateurs()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $categories = $this->categorieDao->getAllCategories();
        $utilisateurs = $this->utilisateurDao->getAllUtilisateurs();
        require_once dirname(__DIR__) . '\vue\utilisateurs.php';
    }
    public function showCreateUtilisateur()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $categories = $this->categorieDao->getAllCategories();
        require_once dirname(__DIR__) . '\vue\editUtilisateur.php';
    }

    public function showEditUtilisateur($id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $utilisateur = $this->utilisateurDao->getUtilisateurById($id);
        require_once dirname(__DIR__) . '\vue\editUtilisateur.php';
    }

    public function createUtilisateur($utilisateur)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $this->utilisateurDao->createUtilisateur($utilisateur);
        header('Location: index.php?action=utilisateurs');
    }

    public function updateUtilisateur($utilisateur)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $this->utilisateurDao->updateUtilisateur($utilisateur);
        header('Location: index.php?action=utilisateurs');
    }

    public function deleteUtilisateur($id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $this->utilisateurDao->deleteUtilisateur($id);
        header('Location: index.php?action=utilisateurs');
    }

    public function createToken($user_id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $token = $this->tokenDao->createToken($user_id);
        echo "Token créé: " . $token;
    }

    public function deleteToken($id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrateur') {
            header('Location: index.php?action=connexion&error=Unauthorized');
            exit();
        }
        $this->tokenDao->deleteToken($id);
        echo "Token supprimé.";
    }
    // Méthode pour gérer la connexion
    public function login($username, $password)
    {
        $user = $this->utilisateurDao->verifyUser($username, $password);
        if ($user) {
            $_SESSION['utilisateur_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?action=home');
        } else {
            header('Location: index.php?action=connexion&error=Invalid credentials');
        }
    }

    // Méthode pour gérer la déconnexion
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}
