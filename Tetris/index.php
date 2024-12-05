<?php
session_start();

// Initialisation du score dans la session si nécessaire
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0; // Initialisation du score à 0
}

// Mise à jour du score depuis AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
    $_SESSION['score'] = $_POST['score'];
    echo "Score enregistré : " . $_SESSION['score'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tetris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        canvas {
            border: 1px solid #fff;
            margin-top: 20px;
            background-color: #111;
        }
        #gameOverMessage {
            display: none;
            font-size: 30px;
            color: red;
            margin-top: 20px;
        }
        #score {
            font-size: 24px;
        }
        .buttons {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #444;
            border: none;
            color: white;
            margin: 10px;
        }
        button:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <h1>Tetris</h1>
    <div id="score">Score: <?php echo $_SESSION['score']; ?></div>
    <canvas id="tetris" width="300" height="600"></canvas>
    <div id="gameOverMessage">
        <p>Game Over!</p>
        <p>Score: <span id="finalScore">0</span></p>
    </div>
    <div class="buttons">
        <button id="startButton">Démarrer le jeu</button>
        <button id="restartButton" style="display: none;">Rejouer</button>
    </div>

    <script src="tetris.js"></script>
</body>
</html>
