const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');

// Taille du canvas
canvas.width = 800;
canvas.height = 400;

// Variables principales
let zombies = [];
let projectiles = [];
let plants = [];
let gameRunning = true;
let sunPoints = 100;
let timeElapsed = 0; // Temps écoulé
let difficultyIncrement = 0; // Pour augmenter la difficulté
let selectedPlant = null; // Type de plante sélectionnée pour être placée
let previewPlantPosition = { x: 0, y: 0 }; // Position de la prévisualisation
let gridSize = canvas.width / 5; // Taille dynamique d'une case
let lives = 3; // Le joueur commence avec 3 vies

// Obtenez les éléments du bouton et du modal
const infoButton = document.getElementById('infoButton');
const infoModal = document.getElementById('infoModal');
const closeButton = document.getElementById('closeButton');

// Ouvrir le pop-up lorsque le bouton est cliqué
infoButton.addEventListener('click', () => {
  infoModal.style.display = 'block';
});

// Fermer le pop-up lorsque l'utilisateur clique sur le bouton de fermeture
closeButton.addEventListener('click', () => {
  infoModal.style.display = 'none';
});

// Fermer le pop-up si l'utilisateur clique en dehors du contenu
window.addEventListener('click', (event) => {
  if (event.target === infoModal) {
    infoModal.style.display = 'none';
  }
});


// Ajustement responsive du canvas
function resizeCanvas() {
  const columns = 5; // Nombre maximum de colonnes
  const rows = 8; // Plus de lignes pour une zone de combat plus haute

  const aspectRatio = columns / rows; // Nouveau ratio
  canvas.width = Math.min(window.innerWidth * 0.7, 600); // Réduction de la largeur maximale
  canvas.height = canvas.width / aspectRatio; // Augmenter la hauteur relative

  gridSize = canvas.width / columns; // Taille de chaque cellule
}
resizeCanvas();
window.addEventListener('resize', resizeCanvas);


// Types de plantes
const plantTypes = {
  basic: { cooldown: 150, damage: 20, cost: 50, color: 'green', health: 100 },
  fast: { cooldown: 100, damage: 10, cost: 75, color: 'lightgreen', health: 75 },
  heavy: { cooldown: 200, damage: 40, cost: 100, color: 'darkgreen', health: 150 },
};
// Charger les images des plantes avec gestion des extensions
const plantImages = {};

function loadPlantImages() {
  const extensions = ['.png', '.jpg']; // Extensions possibles
  Object.keys(plantTypes).forEach((type) => {
    let img = new Image();
    img.onload = () => {
      plantImages[type] = img; // Charger si l'image est valide
    };
    img.onerror = () => {
      // Essayer une autre extension si échec
      const altExt = extensions.find((ext) => ext !== img.src.slice(-4));
      if (altExt) {
        img.src = `image/${type}${altExt}`;
      } else {
        console.error(`Image not found for plant type: ${type}`);
      }
    };

    img.src = `image/${type}.png`; // Commence par essayer .png
  });
}

// Appeler cette fonction au démarrage
loadPlantImages();

// Charger les images des zombies avec gestion des extensions
const zombieImages = {};

function loadZombieImages() {
  const extensions = ['.png', '.jpg']; // Extensions possibles
  ['basic', 'fast', 'strong', 'boss'].forEach((type) => {
    let img = new Image();
    img.onload = () => {
      zombieImages[type] = img; // Charger si l'image est valide
    };
    img.onerror = () => {
      // Essayer une autre extension si échec
      const altExt = extensions.find((ext) => ext !== img.src.slice(-4));
      if (altExt) {
        img.src = `image/zombies/${type}${altExt}`;
      } else {
        console.error(`Image not found for zombie type: ${type}`);
      }
    };

    img.src = `image/zombies/${type}.png`; // Commence par essayer .png
  });
}

// Appeler cette fonction au démarrage
loadZombieImages();


// Classe Plante
class Plant {
  constructor(col, row, type) {
    this.x = col * gridSize;
    this.y = row * gridSize;
    this.width = gridSize * 0.9;
    this.height = gridSize * 0.9;
    this.type = type;
    this.cooldown = 0;
    this.health = plantTypes[type].health;
  }

  shoot() {
    if (this.cooldown <= 0) {
      projectiles.push(
        new Projectile(
          this.x + this.width / 2,
          this.y,
          plantTypes[this.type].damage
        )
      );
      this.cooldown = plantTypes[this.type].cooldown;
    }
  }

  update() {
    if (this.cooldown > 0) this.cooldown--;
  }

  draw() {
    const img = plantImages[this.type];
    if (img) {
      ctx.drawImage(img, this.x, this.y, this.width, this.height);
    } else {
      console.error(`Image not loaded for plant type: ${this.type}`);
    }

    // Barre de vie
    ctx.fillStyle = 'red';
    ctx.fillRect(this.x, this.y - 5, this.width, 5);
    ctx.fillStyle = 'green';
    ctx.fillRect(
      this.x,
      this.y - 5,
      (this.health / plantTypes[this.type].health) * this.width,
      5
    );
  }
}


// Classe Zombie
class Zombie {
  constructor(type) {
    this.x = Math.floor(Math.random() * 5) * gridSize; // Colonne aléatoire
    this.y = -gridSize; // Commence hors de la zone visible
    this.width = gridSize * 0.9;
    this.height = gridSize * 0.9;
    this.speed = gridSize * 0.005; // Vitesse adaptée
    this.health = 50;
    this.color = 'brown';
    this.type = type; // Type de zombie
    this.attackCooldown = 0;

    if (type === 'fast') {
      this.speed *= 2;
      this.health = 30;
    } else if (type === 'strong') {
      this.health = 100;
    } else if (type === 'boss') {
      this.width = gridSize * 1.5;
      this.height = gridSize * 1.5;
      this.health = 300;
      this.speed *= 0.5;
    }
  }

  update() {
    if (this.attackCooldown > 0) {
      this.attackCooldown--;
    } else {
      this.y += this.speed;  // Les zombies se déplacent vers le bas (ajouter une vitesse verticale)
    }
  }

  draw() {
    const img = zombieImages[this.type];
    if (img) {
      ctx.drawImage(img, this.x, this.y, this.width, this.height);
    } else {
      console.error(`Image not loaded for zombie type: ${this.type}`);
    }

    // Afficher la barre de vie
    ctx.fillStyle = 'red';
    ctx.fillRect(this.x, this.y - 5, this.width, 3);
    ctx.fillStyle = 'green';
    ctx.fillRect(
      this.x,
      this.y - 5,
      (this.health / (this.type === 'boss' ? 300 : 50)) * this.width,
      3
    );
  }
}

// Classe Projectile
class Projectile {
  constructor(x, y, damage) {
    this.x = x;
    this.y = y;
    this.radius = gridSize * 0.1; // Taille relative
    this.speed = gridSize * 0.05; // Ajuster la vitesse à l'échelle
    this.damage = damage;
  }

  update() {
    //vers la gauche
    //this.x += this.speed;
    //vers le haut
    this.y -= this.speed;
  }

  draw() {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
    ctx.fillStyle = this.color;
    ctx.fill();
    ctx.closePath();
  }
}

// Mettre à jour les icônes des plantes dans le HTML
function updatePlantIcons() {
  Object.keys(plantTypes).forEach((type) => {
    const plantElement = document.getElementById(`${type}-plant`);
    const iconElement = plantElement.querySelector('.icon');

    // Vérifiez si le joueur a assez de soleil
    if (sunPoints >= plantTypes[type].cost) {
      plantElement.classList.remove('red'); // Fond normal
      iconElement.style.backgroundColor = plantTypes[type].color; // Couleur de l'icône
    } else {
      plantElement.classList.add('red'); // Fond rouge si pas assez de soleil
      iconElement.style.backgroundColor = 'grey'; // Griser l'icône
    }

    // Mettre à jour le texte des coûts
    const costElement = plantElement.querySelector('.plant-cost');
    costElement.textContent = `(${plantTypes[type].cost} Suns)`;
  });

  // Mettre à jour le compteur de points de soleil
  document.getElementById('sun-points').textContent = sunPoints;
}

// Gestion du clic pour sélectionner une plante à poser
document.querySelectorAll('.icon').forEach((plant) => {
  plant.addEventListener('click', (e) => {
    const plantType = e.target.id.replace('-plant', '');
    if (sunPoints >= plantTypes[plantType].cost) {
      selectedPlant = plantType; // Sélectionner la plante
    }
  });
});

// Gestion du clic sur le terrain pour poser la plante
canvas.addEventListener('click', (e) => {
  if (selectedPlant) {
    const rect = canvas.getBoundingClientRect();
    const col = Math.floor((e.clientX - rect.left) / gridSize);
    const row = Math.floor((e.clientY - rect.top) / gridSize);

    // Vérification et placement de la plante
    if (
      sunPoints >= plantTypes[selectedPlant].cost &&
      !plants.some((p) => p.x === col * gridSize && p.y === row * gridSize)
    ) {
      plants.push(new Plant(col, row, selectedPlant));
      sunPoints -= plantTypes[selectedPlant].cost;
    }

    selectedPlant = null; // Réinitialisation de la sélection de plante
  }
});

// Suivi de la souris pour la prévisualisation de la plante
canvas.addEventListener('mousemove', (e) => {
  if (selectedPlant) {
    const rect = canvas.getBoundingClientRect();
    const col = Math.floor((e.clientX - rect.left) / gridSize);
    const row = Math.floor((e.clientY - rect.top) / gridSize);

    // Vérifier si les positions sont dans les limites du canvas
    if (col >= 0 && col < canvas.width / gridSize && row >= 0 && row < canvas.height / gridSize) {
      previewPlantPosition.col = col;
      previewPlantPosition.row = row;
    } else {
      // Si hors limite, réinitialiser la prévisualisation
      previewPlantPosition.col = -1;
      previewPlantPosition.row = -1;
    }
  }
});
// Dessiner la prévisualisation de la plante
function drawPreviewPlant() {
  if (selectedPlant && previewPlantPosition.col >= 0 && previewPlantPosition.row >= 0) {
    const { col, row } = previewPlantPosition;
    
    // Calculer la position réelle pour afficher la prévisualisation
    const x = col * gridSize;
    const y = row * gridSize;

    ctx.fillStyle = plantTypes[selectedPlant].color;
    ctx.globalAlpha = 0.5;
    ctx.fillRect(x, y, gridSize * 0.9, gridSize * 0.9); // Ajout d'une petite marge (0.9) pour un effet visuel
    ctx.globalAlpha = 1;
  }
}

function drawHearts() {
  for (let i = 0; i < lives; i++) {
    ctx.fillStyle = 'red';
    ctx.beginPath();
    const x = canvas.width - 30 - i * 25; // Aligner les cœurs
    const y = 10;
    ctx.arc(x, y + 10, 10, 0, Math.PI, true); // Demi-cercle supérieur
    ctx.arc(x + 10, y + 10, 10, 0, Math.PI, true); // Demi-cercle supérieur droit
    ctx.lineTo(x + 5, y + 30); // Pointe du cœur
    ctx.closePath();
    ctx.fill();
  }
}

// Fonction pour redémarrer le jeu
function restartGame() {
  // Réinitialisation des variables de jeu
  gameRunning = true;
  sunPoints = 100;
  lives = 3; // Réinitialisation des vies
  zombies = [];
  plants = [];
  projectiles = [];
  timeElapsed = 0;
  difficultyIncrement = 0;
  
  // Cache le bouton de redémarrage
  document.getElementById('restartButton').style.display = 'none';

  // Démarre la boucle de jeu
  gameLoop();
}

// Fonction appelée lorsqu'un zombie atteint l'arrivée et le jeu est perdu
function endGame() {
  gameRunning = false;
  // Afficher le bouton Restart
  document.getElementById('restartButton').style.display = 'block';
}

// Ajouter un écouteur d'événement sur le bouton Restart
document.getElementById('restartButton').addEventListener('click', restartGame);

// Exemple de logique de fin de jeu : Si un zombie atteint l'arrivée
function checkGameOver() {
  zombies.forEach((zombie) => {
    if (zombie.y + zombie.height >= canvas.height) {
      lives -= 1; // Perdre une vie
      if (lives <= 0) {
        endGame(); // Fin du jeu si plus de vies
      }
      zombies = zombies.filter(z => z !== zombie); // Supprimer le zombie
    }
  });
}

// Boucle principale de jeu avec appel à checkGameOver
function gameLoop() {
  if (!gameRunning) return;

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Logique de mise à jour des plantes, projectiles et zombies...
  // Appelez checkGameOver dans la boucle principale
  checkGameOver();

  // Continue le jeu
  requestAnimationFrame(gameLoop);
}



// Boucle principale
function gameLoop() {
  if (!gameRunning) return;

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  updatePlantIcons();
  drawPreviewPlant(); // Dessiner la prévisualisation de la plante
  drawHearts(); // Dessiner les vies restantes

  plants.forEach((plant) => {
    plant.update();
    plant.draw();
    plant.shoot();
  });

  projectiles = projectiles.filter((proj) => proj.x < canvas.width);
  projectiles.forEach((proj) => {
    proj.update();
    proj.draw();
  });

  if (Math.random() < 0.002 + difficultyIncrement * 0.001) {
    const zombieType =
      Math.random() < 0.5 + difficultyIncrement * 0.1
        ? 'fast'
        : Math.random() < 0.3
        ? 'strong'
        : 'basic';
    zombies.push(new Zombie(zombieType));
  }

  zombies.forEach((zombie, index) => {
    zombie.update();
    zombie.draw();

    projectiles.forEach((proj, projIndex) => {
      if (
        proj.x > zombie.x &&
        proj.x < zombie.x + zombie.width &&
        proj.y > zombie.y &&
        proj.y < zombie.y + zombie.height
      ) {
        zombie.health -= proj.damage;
        projectiles.splice(projIndex, 1);
      }
    });

    plants.forEach((plant, plantIndex) => {
      if (
        zombie.x < plant.x + plant.width &&
        zombie.x + zombie.width > plant.x &&
        zombie.y < plant.y + plant.height &&
        zombie.y + zombie.height > plant.y
      ) {
        if (zombie.attackCooldown === 0) {
          plant.health -= 10; // Zombie attaque la plante
          zombie.attackCooldown = 60; // Temps de recharge pour l'attaque
        }
        if (plant.health <= 0) {
          plants.splice(plantIndex, 1); // Supprime la plante si elle est détruite
        }
      }
    });

    if (zombie.health <= 0) {
      zombies.splice(index, 1);
      sunPoints += zombie.type === 'boss' ? 100 : 25;
    }

    if (zombie.y + zombie.height >= canvas.height) {
      lives--; // Réduire une vie
      zombies.splice(index, 1); // Supprimer le zombie
    
      if (lives <= 0) {
        gameRunning = false;
        alert('Game Over! Reload to try again.');
      }
    }
  });

  timeElapsed++;
  requestAnimationFrame(gameLoop);
}

gameLoop();
