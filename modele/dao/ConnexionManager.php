<?php
class ConnexionManager
{
    private $host = 'localhost';
    private $db_name = 'mglsi_news';
    private $username = 'mglsi_user';
    private $password = 'passer';
    private $connexion;

    //methode pour se connecter à la base de données
    public function connect()
    {
        try {
            $this->connexion = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connexion;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    //methode pour se deconnecter de la base de données
    public function disconnect()
    {
        $this->connexion = null;
    }
}
