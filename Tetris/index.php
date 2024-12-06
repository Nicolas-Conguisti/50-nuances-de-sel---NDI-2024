<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tetris de Noël</title>
    <style>
        /* Le body prend exactement la hauteur de l'écran */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('./images/christmas-village-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
            height: 100vh; /* Hauteur égale à celle de la fenêtre */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Répartit les éléments pour occuper l'espace */
            align-items: center;
            position: relative; /* Nécessaire pour positionner l'élément sur la droite */
        }

        h1 {
            color: gold;
            text-shadow: 2px 2px 10px red, 0 0 10px gold;
            margin-top: 10px;
            font-size: 5vw; /* S'ajuste à la largeur de l'écran */
        }

        #score {
            font-size: 4vw;
            margin: 0;
            font-weight: bold;
            color: white;
            text-shadow: 0px 0px 10px gold;
        }

        canvas {
            border: 3px solid white;
            background: rgba(0, 0, 0, 0.7); /* Arrière-plan semi-transparent */
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.8);
            aspect-ratio: 1 / 2; /* Maintient les proportions du canvas */
            max-height: 60%; /* Limite la hauteur à 60% de la fenêtre */
            width: auto;
        }

        #gameOverMessage {
            display: none;
            font-size: 20px;
            color: red;
            text-shadow: 0px 0px 10px white;
        }

        .buttons {
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            background: linear-gradient(to bottom, #ff0000, #8b0000);
            border: 2px solid white;
            color: white;
            margin: 5px;
            border-radius: 10px;
            text-shadow: 0px 0px 5px black;
        }

        button:hover {
            background: linear-gradient(to bottom, #ff4500, #ff0000);
            border-color: gold;
        }

        /* Gif positionné à droite */
        .gif-container {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            max-width: 15%;
            z-index: 10;
        }

        .gif-container img {
            width: 100%; /* Le GIF occupe tout l'espace de son conteneur */
            height: auto;
            border: 3px solid gold;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.8);
        }

        /* Petits écrans */
        @media (max-width: 768px) {
            h1 {
                font-size: 7vw;
            }

            #score {
                font-size: 5vw;
            }

            button {
                font-size: 14px;
                padding: 8px 15px;
            }

            canvas {
                max-height: 50%; /* Réduction supplémentaire pour les petits écrans */
            }

            .gif-container {
                max-width: 20%; /* Réduction de la taille du GIF sur petits écrans */
            }
        }
    </style>
</head>
<body>
    <h1>Tetris de Noël</h1>
    <div id="score">Score: <?php echo $_SESSION['score']; ?></div>
    <canvas id="tetris" width="300" height="600"></canvas>
    <div id="gameOverMessage">
        <p>Game Over!</p>
        <p>Score: <span id="finalScore">0</span></p>
    </div>
    <div class="buttons">
        <button id="startButton">🎄 Démarrer le jeu</button>
        <button id="restartButton" style="display: none;">🔄 Rejouer</button>
    </div>

    <!-- Conteneur pour le GIF -->
    <div class="gif-container">
        <img src="./images/grinch.png" alt="Animation festive">
    </div>

    <script src="tetris.js"></script>
</body>
</html>
