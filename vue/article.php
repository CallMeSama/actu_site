<!DOCTYPE html>
<html>

<body>
    <?php foreach ($articles as $article) : ?>
        <h2><?= $article['titre'] ?></h2>
        <p><?= $article['contenu'] ?></p>
        <a href="<?= BASE_URL ?>\index.php?article=<?= $article['id'] ?>">Lire la suite</a>
    <?php endforeach; ?>

    <a href="<?= BASE_URL ?>\index.php">Retour à l'accueil</a>
</body>

</html>