<?php
class ArticleDao
{
    private $connexionManager;

    public function __construct()
    {
        $this->connexionManager = new ConnexionManager();
    }

    public function getArticleById($id)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM article WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $article;
    }

    public function getAllArticles()
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM article');
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $nbArticles = (int) $articles['nb_articles'];
        $this->connexionManager->disconnect();
        return $articles;
    }
    public function getArticlesByPage($page, $nbArticlesParPage)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM article ORDER BY dateCreation DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $nbArticlesParPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', ($page - 1) * $nbArticlesParPage, PDO::PARAM_INT);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $articles;
    }

    public function getTotalArticlesCount()
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT COUNT(*) as nb_articles FROM article');
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC); // Utilisez fetch() avec PDO::FETCH_ASSOC pour récupérer un tableau associatif
        $nbArticles = (int) $article['nb_articles'];
        $this->connexionManager->disconnect();
        return $nbArticles; // Retournez directement le nombre d'articles
    }

    public function createArticle($article)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('INSERT INTO article (titre, contenu, categorie) VALUES (:titre, :contenu, :categorie)');
        $stmt->execute([
            'titre' => $article['titre'],
            'contenu' => $article['contenu'],
            'categorie' => $article['categorie']
        ]);
        $this->connexionManager->disconnect();
    }

    public function updateArticle($article)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('UPDATE article SET titre = :titre, contenu = :contenu, categorie = :categorie WHERE id = :id');
        $stmt->execute([
            'id' => $article['id'],
            'titre' => $article['titre'],
            'contenu' => $article['contenu'],
            'categorie' => $article['categorie']
        ]);
        $this->connexionManager->disconnect();
    }

    public function deleteArticle($id)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('DELETE FROM article WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $this->connexionManager->disconnect();
    }



    public function getArticlesByCategorie($categorie)
    {
        $connexion = $this->connexionManager->connect();
        $stmt = $connexion->prepare('SELECT * FROM article WHERE categorie = :categorie ORDER BY dateCreation DESC');
        $stmt->execute(['categorie' => $categorie]);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->connexionManager->disconnect();
        return $articles;
    }
}
