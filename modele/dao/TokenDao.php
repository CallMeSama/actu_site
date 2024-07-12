<?php class TokenDao
{
    private $connexionManager;

    public function __construct()
    {
        $this->connexionManager = new ConnexionManager();
    }

    public function createToken($utilisateur_id)
    {
        $token = bin2hex(random_bytes(16));
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('INSERT INTO tokens (token, utilisateur_id) VALUES (:token, :utilisateur_id)');
        $stmt->execute(['token' => $token, 'utilisateur_id' => $utilisateur_id]);
        $this->connexionManager->disconnect();
        return $token;
    }

    public function getTokenByUserId($utilisateur_id)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM tokens WHERE utilisateur_id = :utilisateur_id');
        $stmt->execute(['utilisateur_id' => $utilisateur_id]);
        $token = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $token;
    }

    public function deleteToken($id)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('DELETE FROM tokens WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $this->connexionManager->disconnect();
    }
}
