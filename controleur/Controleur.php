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

    public function showAccueil()
    {
        $articles = $this->articleDao->getAllArticles();
        $categories = $this->categorieDao->getAllCategories();
        require_once dirname(__DIR__) . '\vue\accueil.php';
    }

    public function getArticlesByCategorie($categorie)
    {
        return $this->articleDao->getArticlesByCategorie($categorie);
    }

    public function showArticle($id)
    {
        $article = $this->articleDao->getAllArticles($id);
        $categories = $this->categorieDao->getAllCategories();
        require_once dirname(__DIR__) . '\vue\article.php';
    }


    public function showArticleByCategorie($id)
    {
        $categorie = $this->categorieDao->getCategorieById($id);
        $articles = $this->articleDao->getArticlesByCategorie($id);
        require_once dirname(__DIR__) . '\vue\articleByCategorie.php';
    }
}
