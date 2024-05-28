<!DOCTYPE html>
<html>

<body>
    <header>
        <nav>
            <ul>
                <?php
                require_once 'config.php';
                ?>
                <li><a href="<?= BASE_URL ?>/index.php">Accueil</a></li>
                <?php
                require_once 'menu.php'
                ?>
            </ul>
        </nav>
    </header>