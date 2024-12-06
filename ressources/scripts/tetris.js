
const canvas = document.getElementById('tetris');
const context = canvas.getContext('2d');
const rows = 20;
const cols = 10;
const blockSize = 30;
let board = Array.from({ length: rows }, () => Array(cols).fill(null));
let score = 0;  // Initialisation du score à 0, sera mis à jour via AJAX
let currentPiece;
let gameOver = false;
let gameInterval;

// Pièces du Tetris (formes et couleurs)
const pieces = [
    { shape: [[1, 1, 1], [0, 1, 0]], color: 'cyan' }, // T
    { shape: [[1, 1], [1, 1]], color: 'yellow' }, // O
    { shape: [[1, 1, 0], [0, 1, 1]], color: 'green' }, // S
    { shape: [[0, 1, 1], [1, 1, 0]], color: 'red' }, // Z
    { shape: [[1, 0, 0], [1, 1, 1]], color: 'blue' }, // L
    { shape: [[0, 0, 1], [1, 1, 1]], color: 'orange' }, // J
    { shape: [[1, 1, 1, 1]], color: 'purple' } // I
];

// Fonction pour dessiner le tableau
function drawBoard() {
    context.clearRect(0, 0, canvas.width, canvas.height); // Efface le canvas

    // Dessiner les blocs
    for (let y = 0; y < rows; y++) {
        for (let x = 0; x < cols; x++) {
            if (board[y][x]) {
                context.fillStyle = board[y][x];
                context.fillRect(x * blockSize, y * blockSize, blockSize, blockSize);
                context.strokeStyle = 'white';
                context.strokeRect(x * blockSize, y * blockSize, blockSize, blockSize);
            }
        }
    }
}

// Fonction pour dessiner la pièce actuelle
function drawPiece() {
    const shape = currentPiece.shape;
    const color = currentPiece.color;

    for (let y = 0; y < shape.length; y++) {
        for (let x = 0; x < shape[y].length; x++) {
            if (shape[y][x]) {
                context.fillStyle = color;
                context.fillRect((currentPiece.x + x) * blockSize, (currentPiece.y + y) * blockSize, blockSize, blockSize);
                context.strokeStyle = 'white';
                context.strokeRect((currentPiece.x + x) * blockSize, (currentPiece.y + y) * blockSize, blockSize, blockSize);
            }
        }
    }
}

// Fonction pour générer une nouvelle pièce
function generatePiece() {
    const randomPiece = pieces[Math.floor(Math.random() * pieces.length)];
    return { 
        shape: randomPiece.shape, 
        color: randomPiece.color, 
        x: Math.floor(cols / 2) - Math.floor(randomPiece.shape[0].length / 2), 
        y: 0 
    };
}

// Fonction pour gérer la collision
function collision(offsetX = 0, offsetY = 0, shape = currentPiece.shape) {
    for (let y = 0; y < shape.length; y++) {
        for (let x = 0; x < shape[y].length; x++) {
            if (shape[y][x]) {
                const newX = currentPiece.x + x + offsetX;
                const newY = currentPiece.y + y + offsetY;
                if (newX < 0 || newX >= cols || newY >= rows || board[newY] && board[newY][newX]) {
                    return true;
                }
            }
    }
    }
    return false;
}

// Fonction pour faire descendre la pièce
function moveDown() {
    if (!collision(0, 1)) {
        currentPiece.y++;
    } else {
        lockPiece();
        clearLines();
        currentPiece = generatePiece();
        if (collision()) {
            gameOverActions();
        }
    }
}

// Fonction pour fixer la pièce dans le tableau
function lockPiece() {
    const shape = currentPiece.shape;
    const color = currentPiece.color;

    for (let y = 0; y < shape.length; y++) {
        for (let x = 0; x < shape[y].length; x++) {
            if (shape[y][x]) {
                board[currentPiece.y + y][currentPiece.x + x] = color;
                score += 1;  // Incrémente le score pour chaque case posée
                console.log(`Case posée - Score: ${score}`); // Log du score après chaque case posée
                document.getElementById('score').textContent = `Score: ${score}`; // Mise à jour de l'affichage du score
                submitScore(score);  // Envoi du score à PHP via AJAX
            }
        }
    }
}


// Fonction pour nettoyer les lignes complètes
function clearLines() {
    for (let y = rows - 1; y >= 0; y--) {
        if (board[y].every(cell => cell !== null)) {
            board.splice(y, 1);
            board.unshift(Array(cols).fill(null));
            score += 20;  // Ajoute 20 points pour chaque ligne disparue
            console.log(`Ligne disparue - Score: ${score}`); // Log du score après suppression de ligne
            document.getElementById('score').textContent = `Score: ${score}`;  // Mise à jour de l'affichage du score
            submitScore(score);  // Envoi du score à PHP via AJAX
        }
    }
}

// Fonction pour gérer la fin du jeu
function gameOverActions() {
    gameOver = true;
    document.getElementById('gameOverMessage').style.display = 'block';
    document.getElementById('finalScore').textContent = score;
    document.getElementById('restartButton').style.display = 'inline-block';
}

// Fonction pour envoyer le score à PHP via AJAX (avec XMLHttpRequest)
function submitScore(score) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_score.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Score mis à jour : ' + xhr.responseText);
        }
    };
    xhr.send('score=' + score);  // Envoi du score dans la requête POST
}

// Fonction pour la rotation des pièces
function rotatePiece(shape) {
    return shape[0].map((_, index) => shape.map(row => row[index])).reverse();
}

// Fonction pour démarrer le jeu
let lastTime = 0;

function gameLoop(timestamp) {
    const deltaTime = timestamp - lastTime;
    if (deltaTime > 100) { // Ajustez le seuil pour obtenir la vitesse désirée
        if (!gameOver) {
            moveDown();
            drawBoard();
            drawPiece();
        }
        lastTime = timestamp;
    }

    if (!gameOver) {
        requestAnimationFrame(gameLoop);
    }
}

function startGame() {
    board = Array.from({ length: rows }, () => Array(cols).fill(null));
    score = 0;
    document.getElementById('score').textContent = `Score: ${score}`;
    currentPiece = generatePiece();
    gameOver = false;
    document.getElementById('gameOverMessage').style.display = 'none';
    document.getElementById('restartButton').style.display = 'none';
    requestAnimationFrame(gameLoop);  // Lancer l'animation du jeu
}

// Fonction pour les contrôles au clavier
function handleKeyPress(event) {
    if (gameOver) return;  // Ne pas traiter les touches si le jeu est terminé

    switch (event.key) {
        case 'ArrowLeft':
            if (!collision(-1, 0)) {
                currentPiece.x--;
            }
            break;
        case 'ArrowRight':
            if (!collision(1, 0)) {
                currentPiece.x++;
            }
            break;
        case 'ArrowDown':
            moveDown();
            break;
        case 'ArrowUp':
            const rotatedShape = rotatePiece(currentPiece.shape);
            if (!collision(0, 0, rotatedShape)) {
                currentPiece.shape = rotatedShape;
            }
            break;
    }
}

// Lancer le jeu
document.getElementById('startButton').addEventListener('click', startGame);

document.getElementById('restartButton').addEventListener('click', startGame);

// Ajouter l'écouteur pour les touches du clavier
document.addEventListener('keydown', handleKeyPress);

// Récupérer le score actuel au chargement de la page via AJAX
function getScore() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../functions/get_score.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            score = parseInt(xhr.responseText, 10);
            console.log(`Score récupéré au démarrage : ${score}`);  // Log du score récupéré au démarrage
            document.getElementById('score').textContent = `Score: ${score}`;
        }
    };
    xhr.send();
}

getScore();  // Récupérer le score au démarrage du jeu
