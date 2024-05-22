<?php
class CategorieDao
{
    private $connexionManager;

    public function __construct()
    {
        $this->connexionManager = new ConnexionManager();
    }

    public function getCategorieById($id)
    {
        $stmt = $this->connexionManager->connect()->prepare("SELECT * FROM categorie WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAllCategories()
    {
        $stmt = $this->connexionManager->connect()->prepare("SELECT * FROM categorie");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createCategorie($categorie)
    {
        $stmt = $this->connexionManager->connect()->prepare("INSERT INTO categorie (libelle) VALUES (:libelle)");
        $stmt->bindParam(':libelle', $categorie->libelle);
        $stmt->execute();
    }

    public function updateCategorie($categorie)
    {
        $stmt = $this->connexionManager->connect()->prepare("UPDATE categorie SET libelle = :libelle WHERE id = :id");
        $stmt->bindParam(':id', $categorie->id);
        $stmt->bindParam(':libelle', $categorie->libelle);
        $stmt->execute();
    }

    public function deleteCategorie($id)
    {
        $stmt = $this->connexionManager->connect()->prepare("DELETE FROM categorie WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
