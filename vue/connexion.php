<!DOCTYPE html>
<html>

<head>
    <title>Actualités DIC2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>
    <?php require_once 'inc/entete.php';
    require_once 'config.php'; ?>

    <div class="container p-5">
        <div class="row">
            <!-- Colonne pour le formulaire -->
            <div class="col-md-6 mt-5">
                <h1>Se connecter</h1>
                <form>
                    <div class="mb-4">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">@</span>
                            <input type="text" class="form-control" placeholder="Nom d'utilisateur" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-lock"></i></span>
                            <input type="text" class="form-control" placeholder="Mot de passe" aria-label="password" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <img src="<? BASE_URL ?>./assets/login.svg" alt="Description de l'image" class="img-fluid">
            </div>
        </div>
    </div>

</body>

</html>