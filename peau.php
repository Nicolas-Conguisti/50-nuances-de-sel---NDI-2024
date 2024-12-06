<?php
// Configuration de base
$titre = "Jeu de l'Ours Polaire";
$dateActuelle = date('d/m/Y');
$anneeActuelle = date('Y');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jeu simple où un ours polaire doit éviter les trous sur la banquise.">
    <meta name="author" content="LAVERGNE Elsa aka PÉPITO">
    <title><?php echo $titre; ?></title>
    <!-- Lien vers des fichiers CSS -->
    <link rel="stylesheet" href="./styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #d9f2f2, #b3e0ff);
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        #jeuPolaire {
            margin: 20px auto;
        }

        canvas {
            background-color: #f0f8ff;
            display: block;
            margin: 10px auto;
            border: 2px solid #007bff;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1><?php echo $titre; ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Bienvenue sur le jeu de l'Ours Polaire</h2>
            <p>
                Aidez l'ours polaire à éviter les trous sur la banquise en sautant ! <br>
                Appuyez sur **Espace** pour sauter lorsque le jeu commence.
            </p>

            <div id="jeuPolaire">
                <div id="score">Score : 0</div>
                <button id="startGameButton">Lancer le jeu</button>
                <canvas id="gameCanvas" width="800" height="400"></canvas>
            </div>

            <p>Nous sommes le : <?php echo $dateActuelle; ?></p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo $anneeActuelle; ?> - Tous droits réservés.</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>
