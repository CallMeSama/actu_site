<!DOCTYPE html>
<html>

<head>
    <title>Articles de la catégorie <?= $categorie->libelle ?></title>
</head>

<body>
    <h1>Articles de la catégorie <?= $categorie->libelle ?></h1>

    <?php foreach ($articles as $article) : ?>
        <h2><?= $article->titre ?></h2>
        <p><?= $article->contenu ?></p>
        <a href="<?= BASE_URL ?>/index.php?action=article&id<?= $article['id'] ?>">Lire la suite</a>
    <?php endforeach; ?>

    <a href="<?= BASE_URL ?>\index.php">Retour à l'accueil</a>
</body>

</html>