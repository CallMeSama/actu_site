<?php
require_once dirname(__DIR__) . '\modele\dao\ConnexionManager.php';
require_once dirname(__DIR__) . '\modele\dao\ArticleDao.php';
require_once dirname(__DIR__) . '\modele\dao\CategorieDao.php';

class Controleur
{
    private $articleDao;
    private $categorieDao;

    public function __construct()
    {
        $connexionManager = new ConnexionManager();

        $this->articleDao = new ArticleDao($connexionManager);
        $this->categorieDao = new CategorieDao($connexionManager);
    }

    public function showAccueil($pageCourante)
    {
        $numeroPage = $pageCourante;
        $nombreArticlesParPage = 2; // Définissez le nombre d'articles que vous souhaitez par page
        $totalArticles = $this->articleDao->getTotalArticlesCount(); // Obtenez le nombre total d'articles
        $pages = ceil($totalArticles / $nombreArticlesParPage); // Calculez le nombre total de pages

        $articles = $this->articleDao->getArticlesByPage($numeroPage, $nombreArticlesParPage);
        $categories = $this->categorieDao->getAllCategories();
        require_once dirname(__DIR__) . '\vue\accueil.php';
    }

    public function getArticlesByCategorie($categorie)
    {
        return $this->articleDao->getArticlesByCategorie($categorie);
    }

    public function showArticle($id)
    {
        $article = $this->articleDao->getArticleById($id);
        $categories = $this->categorieDao->getAllCategories();
        require_once dirname(__DIR__) . '\vue\article.php';
    }


    public function showArticleByCategorie($id)
    {
        $categorie = $this->categorieDao->getCategorieById($id);
        $articles = $this->articleDao->getArticlesByCategorie($id);
        $categories = $this->categorieDao->getAllCategories();
        require_once dirname(__DIR__) . '\vue\articleByCategorie.php';
    }

    public function showConnexion()
    {
        require_once dirname(__DIR__) . '\vue\connexion.php';
    }
}
