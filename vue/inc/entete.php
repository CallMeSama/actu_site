<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Actu-Polytech</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php
                require_once 'config.php';
                ?>
                <a class="nav-item nav-link active" href="<?= BASE_URL ?>/index.php">Accueil</a>
                <?php foreach ($categories as $categorie) : ?>
                    <a class="nav-item nav-link" href="<?= BASE_URL ?>/index.php?action=categorie&categorie=<?= $categorie->id ?>"><?= $categorie->libelle ?></a>
                <?php endforeach ?>
            </div>
            <button class="btn btn-outline-primary ml-auto" type="submit">
                <a style="text-decoration:none" class="text-white" href=" <?= BASE_URL ?>/index.php?action=connexion">Se connexion</a>
            </button>

        </div>

    </nav>
</body>

</html>