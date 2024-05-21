<!DOCTYPE html>
<html>

<head>
    <title>Actualités</title>
    <meta charset="UTF-8">
    <!-- Ajoutez le lien vers le CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
        <!-- My navbar brand -->
        <a class="navbar-brand" style="color : rgb(109, 229, 177)" href="index.php">Actualités</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- The navbar items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item nav-item-custom">
                    <a class="nav-link" href="?categorie=sport">Sport</a>
                </li>
                <li class="nav-item nav-item-custom">
                    <a class="nav-link" href="?categorie=sante">Santé</a>
                </li>
                <li class="nav-item nav-item-custom">
                    <a class="nav-link" href="?categorie=education">Education</a>
                </li>
                <li class="nav-item nav-item-custom">
                    <a class="nav-link" href="?categorie=politique">Politique</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Connexion avec la base de donnée et envoie des requêtes -->
    <div class="d-flex flex-column mt-5 mx-5 px-5 align-items-center">
        <?php
        $servername = "localhost";
        $username = "mglsi_user";
        $password = "passer";
        $dbname = "mglsi_news";

        // Connexion et verification de la connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Obtention de la catégorie à partir de l'URL
        $categorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';

        // Modifier la requête SQL pour récupérer seulement les actualités de la catégorie spécifiée
        if ($categorie) {
            $sql = "SELECT Article.titre, Article.contenu, Categorie.libelle FROM Article INNER JOIN Categorie ON Article.categorie = Categorie.id WHERE Categorie.libelle = '$categorie'";
        } else {
            $sql = "SELECT Article.titre, Article.contenu, Categorie.libelle FROM Article INNER JOIN Categorie ON Article.categorie = Categorie.id";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) { ?>
                <div class="">
                    <h4><?= $row["titre"] ?></h4>
                    <h6><?= $row["libelle"] ?></h6>
                    <p><?= $row["contenu"] ?></p>";
                </div>
                <hr><?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
                    ?>
    </div>
    <!-- Ajoutez les scripts JavaScript de Bootstrap à la fin de votre corps de document -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>