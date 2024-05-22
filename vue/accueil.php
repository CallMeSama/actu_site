<!DOCTYPE html>
<html>

<head>
    <title>Actualités DIC2</title>
    <!-- Ici, vous pouvez inclure vos fichiers CSS, JavaScript, etc. -->
</head>

<body>
    <?php require_once 'inc/entete.php'; ?>

    <!-- Ici, vous pouvez inclure votre barre de navigation, etc. -->

    <div class="contenu">
        <?php if (!empty($articles)) : ?>
            <?php
            require_once 'config.php';
            foreach ($articles as $article) : ?>
                <div class="article">
                    <h3><a href="<?= BASE_URL ?>/index.php?article=<?= $article['id'] ?>"><?= $article['titre'] ?></a></h3>
                    <p><?= $article->contenu !== null ? substr($article->contenu, 0, 300) . '...' : '' ?></p>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="message">Aucun article trouvé</div>
        <?php endif ?>
    </div>
    <?php require_once 'inc/menu.php'; ?>
</body>

</html>