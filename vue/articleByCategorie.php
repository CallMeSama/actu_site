<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php require_once 'inc/entete.php'; ?>
    <div class="container p-5">
        <h1 class="text-center">Articles de la catégorie <?= $categorie->libelle ?></h1>
        <?php
        require_once 'config.php';
        foreach ($articles as $article) : ?>
            <div class="card border-dark my-3">
                <div class="card-body">
                    <h2 class="card-title"><a href="<?= BASE_URL ?>/index.php?action=article&id=<?= $article['id'] ?>"><?= $article['titre'] ?></a></h2>
                    <p><?= date("d/m/Y", strtotime($article['dateCreation'])) ?></p>
                    <p class="card-text"><?= $article['resume'] ?></p>

                </div>
            </div>
        <?php endforeach ?>

    </div>
</body>

</html>