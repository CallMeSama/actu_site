<?php
require_once dirname(__DIR__) . '\modele\dao\ConnexionManager.php';
require_once dirname(__DIR__) . '\modele\dao\UtilisateurDao.php';
class ConnexionControleur
{
    private $utilisateurDao;

    public function __construct()
    {
        $this->utilisateurDao = new UtilisateurDao();
        session_start();
    }

    public function showConnexion()
    {
        require_once dirname(__DIR__) . '\vue\connexion.php';
    }

    public function login($username, $password)
    {
        $user = $this->utilisateurDao->verifyUser($username, $password);

        if ($user !== false) {
            $_SESSION['utilisateur_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit();
        } else {
            header('Location: index.php?action=connexion&error=Informations non valides');
            exit();
        }
    }

    // Méthode pour gérer la déconnexion
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}
