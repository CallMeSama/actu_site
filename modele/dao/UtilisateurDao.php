<?php
class UtilisateurDao
{
    private $connexionManager;

    public function __construct()
    {
        $this->connexionManager = new ConnexionManager();
    }
    public function getAllUtilisateurs()
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM utilisateur');
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $utilisateurs;
    }
    public function getUtilisateurById($id)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM utilisateur WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $utilisateur;
    }
    public function getUtilisateurByUsername($username)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM utilisateur WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $utilisateur;
    }

    public function verifyUser($username, $password)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM utilisateur WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $this->connexionManager->disconnect();
            return $user;
        }
        $this->connexionManager->disconnect();
        return false;
    }
    public function createUtilisateur($utilisateur)
    {
        $connexion = $this->connexionManager->connect();
        // Hachage du mot de passe
        $hashedPassword = password_hash($utilisateur['password'], PASSWORD_DEFAULT);
        $stmt = $connexion->prepare('INSERT INTO utilisateur (username, password, role) VALUES (:username, :password, :role)');
        $stmt->execute([
            'username' => $utilisateur['username'],
            'password' => $hashedPassword, // Utilisez le mot de passe haché
            'role' => $utilisateur['role']
        ]);
        $this->connexionManager->disconnect();
    }

    public function updateUtilisateur($utilisateur)
    {
        $connexion = $this->connexionManager->connect();
        // Hachage du mot de passe seulement si un nouveau mot de passe est fourni
        if (!empty($utilisateur['password'])) {
            $hashedPassword = password_hash($utilisateur['password'], PASSWORD_DEFAULT);
        } else {
            // Récupérez le mot de passe actuel de la base de données si aucun nouveau mot de passe n'est fourni
            $stmt = $connexion->prepare('SELECT password FROM utilisateur WHERE id = :id');
            $stmt->execute(['id' => $utilisateur['id']]);
            $hashedPassword = $stmt->fetchColumn();
        }
        $stmt = $connexion->prepare('UPDATE utilisateur SET username = :username, password = :password, role = :role WHERE id = :id');
        $stmt->execute([
            'id' => $utilisateur['id'],
            'username' => $utilisateur['username'],
            'password' => $hashedPassword, // Utilisez le mot de passe haché ou le mot de passe existant
            'role' => $utilisateur['role']
        ]);
        $this->connexionManager->disconnect();
    }

    public function deleteUtilisateur($id)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('DELETE FROM utilisateur WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $this->connexionManager->disconnect();
    }
}
