<!DOCTYPE html>
<html>

<head>
    <title>Actualités DIC2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php require_once 'inc/entete.php'; ?>

    <div class="container p-5">
        <h1 class="text-center">Tous les articles</h1>
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
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($numeroPage == 1) ? "disabled" : "" ?>">
                    <a href="<?= BASE_URL ?>/index.php?page=<?= $numeroPage - 1 ?>" class="page-link">Précédente</a>
                </li>
                <?php
                for ($page = 1; $page <= $pages; $page++) : ?>
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($numeroPage == $page) ? "active" : "" ?>">
                        <a href="<?= BASE_URL ?>/index.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                    </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item <?= ($numeroPage == $pages) ? "disabled" : "" ?>">
                    <a href="<?= BASE_URL ?>/index.php?page=<?= $numeroPage + 1 ?>" class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>