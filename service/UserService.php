<?php
require_once dirname(__DIR__) . '\modele\dao\UtilisateurDao.php';
require_once dirname(__DIR__) . '\modele\dao\TokenDao.php';

class UserService
{
    private $utilisateurDao;
    private $tokenDao;

    public function __construct()
    {
        $this->utilisateurDao = new UtilisateurDao();
        $this->tokenDao = new TokenDao();
    }

    // Service pour récupérer la liste des utilisateurs en vérifiant le token
    public function listUsers($token)
    {
        $this->authenticate($token);
        $users = $this->utilisateurDao->getAllUtilisateurs();
        return $users;
    }

    // Service pour ajouter un utilisateur en vérifiant le token
    public function addUser($token, $username, $password, $role)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->createUtilisateur($username, $password, $role);
    }

    // Service pour supprimer un utilisateur en vérifiant le token
    public function deleteUser($token, $id)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->deleteUtilisateur($id);
    }

    // Service pour mettre à jour un utilisateur en vérifiant le token
    public function updateUser($token, $id, $username, $password, $role)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->updateUtilisateur($id, $username, $password, $role);
    }

    // Service pour authentifier un utilisateur
    public function authenticateUser($username, $password)
    {
        return $this->utilisateurDao->verifyUser($username, $password);
    }

    // Service pour verifier le token pour un utilisateur pour qu'il accèdé aux ressources protégées
    private function authenticate($token)
    {
        if (!$this->tokenDao->validateToken($token)) {
            throw new Exception('Token invalide ou expiré');
        }
    }
}