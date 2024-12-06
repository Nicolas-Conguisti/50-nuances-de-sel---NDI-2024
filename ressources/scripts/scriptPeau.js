// Variables du canvas et du contexte
const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');
const scoreElement = document.getElementById('score');
const hitboxPadding = 10; // Réduction de la hitbox

// Variables du jeu
const player = { x: 50, y: 300, width: 50, height: 50, dy: 0, jumping: false };
let holes = [];
let score = 0;
let gameRunning = false;

// Paramètres de la physique
const gravity = 0.5;
const groundHeight = 50;
const jumpStrength = -10;
let interval = 30;

// Chargement des images
const imageOursPolaire = new Image();
imageOursPolaire.src = "./ressources/img/polarBear.png";

// Fonction pour dessiner les objets
function dessinerLesObjets() {
    // Effacer tout le canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Dessiner l'ours polaire
    ctx.drawImage(imageOursPolaire, player.x, player.y, player.width, player.height);

    // Dessiner le sol
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, canvas.height - groundHeight, canvas.width, groundHeight);

    // Dessiner la hitbox centrée et fine
    ctx.strokeStyle = 'red';
    const hitboxWidth = 20; // Largeur réduite de la hitbox
    const hitboxHeight = player.height - 10; // Hauteur de la hitbox légèrement réduite pour plus de tolérance
    const hitboxX = player.x + player.width / 2 - hitboxWidth / 2; // Centrer la hitbox sur l'ours
    const hitboxY = player.y + 5; // Positionner légèrement plus bas pour être plus permissif

    ctx.strokeRect(hitboxX, hitboxY, hitboxWidth, hitboxHeight); // Dessiner la hitbox
    
    // Dessiner les trous
    holes.forEach(hole => {
        ctx.clearRect(hole.x, canvas.height - groundHeight, hole.width, groundHeight);
    });
}

// Fonction principale du jeu
function gameLoop() {
    if (!gameRunning) return; // Arrêter le jeu si nécessaire

    // Mettre à jour les positions et vérifier les collisions
    updateGame();

    // Dessiner les objets
    dessinerLesObjets();

    // Refaire tourner la boucle
    requestAnimationFrame(gameLoop);
}

// Mise à jour des positions et des collisions
function updateGame() {
    // Appliquer la gravité au joueur
    player.y += player.dy;
    player.dy += gravity;

    // Empêcher le joueur de passer à travers le sol
    if (player.y + player.height >= canvas.height - groundHeight) {
        player.y = canvas.height - groundHeight - player.height;
        player.dy = 0; // Arrêter la descente du joueur lorsqu'il touche le sol
        player.jumping = false;
    }

    // Déplacer les trous
    for (let i = holes.length - 1; i >= 0; i--) {
        holes[i].x -= 5;

        // Vérifier si le trou est hors de l'écran
        if (holes[i].x + holes[i].width <= 0) {
            holes.splice(i, 1); // Supprimer le trou
            score += 10; // Augmenter le score
            continue;
        }

        // Vérification de la collision avec la hitbox
        const hitboxWidth = 20; // Largeur de la hitbox
        const hitboxHeight = player.height - 10; // Hauteur de la hitbox
        const hitboxX = player.x + player.width / 2 - hitboxWidth / 2; // Position X de la hitbox
        const hitboxY = player.y + 5; // Position Y de la hitbox

        // Vérification de la collision entre la hitbox et les trous
        const holeBottom = canvas.height - groundHeight; // Position du bas des trous
        
        

        if (
            hitboxX + hitboxWidth > holes[i].x &&  // Le côté droit de la hitbox dépasse le côté gauche du trou
            hitboxX < holes[i].x + holes[i].width &&  // Le côté gauche de la hitbox dépasse le côté droit du trou
            hitboxY + hitboxHeight > canvas.height - holeBottom && // La partie inférieure de la hitbox touche le niveau du sol
            player.jumping == false
        ) {
            console.log('Collision détectée !');  // Ajout d'un log pour déboguer
            endGame(); // Fin de la partie
        }
    }

    // Générer de nouveaux trous
    if (Math.random() < 0.02 && interval <=0) {
            holes.push({ x: canvas.width, width: Math.random() * 100 + 30 });
            interval = 30;
        }
        else{
            interval = interval-1;
        }
        
    
    

    // Mettre à jour le score
    scoreElement.textContent = `Score : ${score}`;
}

// Gestion des événements (saut)
document.addEventListener('keydown', (e) => {
    if (e.code === 'Space' && !player.jumping && gameRunning) {
        player.jumping = true;
        player.dy = jumpStrength; // Appliquer une force vers le haut
    }
});

// Initialisation du jeu
function init() {
    score = 0;
    holes = [];
    player.y = 300;
    player.dy = 0;
    player.jumping = false;
    gameRunning = true;

    dessinerLesObjets();
    gameLoop();
}

// Fin du jeu
function endGame() {
    gameRunning = false;
    alert(`Jeu terminé ! Score final : ${score}`);
}

// Bouton pour démarrer le jeu
document.getElementById('startGameButton').addEventListener('click', () => {
    if (!gameRunning) {
        init();
    }
});