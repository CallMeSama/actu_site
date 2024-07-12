<?php
require_once __DIR__ . '/modele/dao/UtilisateurDao.php';
require_once __DIR__ . '/modele/dao/TokenDao.php';

class UserService
{
    private $utilisateurDao;
    private $tokenDao;

    public function __construct()
    {
        $this->utilisateurDao = new UtilisateurDao();
        $this->tokenDao = new TokenDao();
    }

    public function listUsers($token)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->getAllUtilisateurs();
    }

    public function addUser($token, $username, $password, $role)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->createUtilisateur($username, $password, $role);
    }

    public function deleteUser($token, $id)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->deleteUtilisateur($id);
    }

    public function updateUser($token, $id, $username, $password, $role)
    {
        $this->authenticate($token);
        return $this->utilisateurDao->updateUtilisateur($id, $username, $password, $role);
    }

    public function authenticateUser($username, $password)
    {
        return $this->utilisateurDao->verifyUser($username, $password);
    }

    private function authenticate($token)
    {
        if (!$this->tokenDao->validateToken($token)) {
            throw new Exception('Token invalide ou expiré');
        }
    }
}

$server = new SoapServer(null, array('uri' => "http://localhost/actu_site/soap_server.php"));
$server->setClass('UserService');   
$server->handle();
