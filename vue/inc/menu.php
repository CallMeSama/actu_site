<!DOCTYPE html>

<body>
    <div id="menu">
        <ul><?php
            require_once 'config.php';
            ?>
            <li><a href="<?= BASE_URL ?>/index.php">Tout</a></li>
            <?php foreach ($categories as $categorie) : ?>
                <li><a href="<?= BASE_URL ?>/index.php?action=categorie&categorie=<?= $categorie->id?>"><?= $categorie->libelle ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</body>

</html>