<?php
header('Content-Type: application/json');

require_once dirname(__DIR__) . '\modele\dao\ArticleDao.php';
require_once dirname(__DIR__) . '\ArticleService.php';

// Traitement des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Initialisation du service
    $articleService = new ArticleService();

    // Récupérer les paramètres
    $format = isset($_GET['format']) ? $_GET['format'] : 'json';
    $categorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;

    // Gestion des actions
    if (empty($categorie)) {
        // Récupérer tous les articles
        echo $articleService->getAllArticles($format);
    } else {
        // Récupérer les articles par catégorie
        echo $articleService->getArticlesByCategories($format, $categorie);
    }
} else {
    // Gérer les autres méthodes HTTP (POST, PUT, DELETE) si nécessaire
    http_response_code(405); // Méthode non autorisée
    echo json_encode(array('message' => 'Méthode non autorisée'));
}
