<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tetris de Noël</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://images.unsplash.com/photo-1543761036-cdfb3f882c8b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920') no-repeat center center fixed;
            background-size: cover; /* Image de fond pleine page */
            color: white;
            text-align: center;
        }

        h1 {
            color: gold;
            text-shadow: 2px 2px 10px red, 0 0 10px gold;
            margin-top: 20px;
        }

        #score {
            font-size: 28px;
            margin-top: 10px;
            font-weight: bold;
            color: white;
            text-shadow: 0px 0px 10px gold;
        }

        canvas {
            border: 3px solid white;
            margin-top: 20px;
            background: rgba(0, 0, 0, 0.7); /* Arrière-plan semi-transparent */
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.8); /* Effet lumineux */
        }

        #gameOverMessage {
            display: none;
            font-size: 30px;
            color: red;
            margin-top: 20px;
            text-shadow: 0px 0px 10px white;
        }

        .buttons {
            margin-top: 20px;
        }

        button {
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            background: linear-gradient(to bottom, #ff0000, #8b0000); /* Dégradé rouge intense */
            border: 2px solid white;
            color: white;
            margin: 10px;
            border-radius: 10px;
            text-shadow: 0px 0px 5px black;
        }

        button:hover {
            background: linear-gradient(to bottom, #ff4500, #ff0000); /* Couleurs plus claires au survol */
            border-color: gold;
        }

        #tetris {
            margin: 0 auto;
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

    <script src="tetris.js"></script>
</body>
</html>
