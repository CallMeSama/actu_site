<?php
require_once 'modele/dao/ArticleDao.php';

class ArticleService
{
    private $articleDao;

    public function __construct()
    {
        $this->articleDao = new ArticleDao();
    }

    /**
     * Récupère la liste de tous les articles.
     * Retourne les articles au format XML ou JSON selon le choix de l'utilisateur.
     * 
     * @param string $format Le format de retour ('xml' ou 'json')
     * @return string Liste des articles au format spécifié
     */
    public function getAllArticles($format = 'json')
    {
        $articles = $this->articleDao->getAllArticles();

        if ($format == 'json') {
            header('Content-Type: application/json');
            return json_encode($articles);
        } elseif ($format == 'xml') {
            header('Content-Type: application/xml');
            $xml = new SimpleXMLElement('<articles/>');
            foreach ($articles as $article) {
                $item = $xml->addChild('article');
                $item->addChild('id', $article['id']);
                $item->addChild('titre', $article['titre']);
                $item->addChild('description', $article['description']);
                $item->addChild('contenu', $article['contenu']);
                $item->addChild('categorie', $article['categorie']);
                $item->addChild('dateCreation', $article['dateCreation']);
                $item->addChild('dateModification', $article['dateModification']);
            }
            return $xml->asXML();
        } else {
            throw new InvalidArgumentException('Format de réponse non supporté.');
        }
    }

    /**
     * Récupère la liste des articles regroupés par catégories.
     * Retourne les articles au format XML ou JSON selon le choix de l'utilisateur.
     * 
     * @param string $format Le format de retour ('xml' ou 'json')
     * @return string Liste des articles regroupés par catégories au format spécifié
     */
    public function getArticlesByCategories($format = 'json', $categorie)
    {
        $articlesByCategories = $this->articleDao->getArticlesByCategorie($categorie);

        if ($format == 'json') {
            header('Content-Type: application/json');
            return json_encode($articlesByCategories);
        } elseif ($format == 'xml') {
            header('Content-Type: application/xml');
            $xml = new SimpleXMLElement('<articles/>');
            var_dump($articlesByCategories);
            foreach ($articlesByCategories as $categorie => $articles) {
                $categoryNode = $xml->addChild('categorie');
                $categoryNode->addChild('name', $categorie);
                foreach ($articles as $article) {
                    $item = $categoryNode->addChild('article');
                    $item->addChild('id', $article['id']);
                    $item->addChild('titre', $article['titre']);
                    $item->addChild('description', $article['description']);
                    $item->addChild('contenu', $article['contenu']);
                    $item->addChild('dateCreation', $article['dateCreation']);
                    $item->addChild('dateModification', $article['dateModification']);
                }
            }

            return $xml->asXML();
        } else {
            throw new InvalidArgumentException('Format de réponse non supporté.');
        }
    }
}