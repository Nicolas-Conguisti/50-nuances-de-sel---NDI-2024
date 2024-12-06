<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plants vs Zombies</title>
  <link rel="stylesheet" href="ressources/styles/style.css">
  <link rel="stylesheet" href="ressources/styles/styleFoie.css">
</head>
<body>
<?php include('ressources/components/header.php'); ?>
    <div class="game-container">
        <canvas id="gameCanvas"></canvas>
        <div class="sidebar">
          <div class="plant" id="basic-plant">
            <div class="icon plant" id="basic-plant"></div>
            <span class="plant-cost">50</span>
          </div>
          <div class="plant" id="fast-plant">
            <div class="icon plant" id="fast-plant"></div>
            <span class="plant-cost">75</span>
          </div>
          <div class="plant" id="heavy-plant">
            <div class="icon plant" id="heavy-plant"></div>
            <span class="plant-cost">100</span>
          </div>
          <p>Sun Points: <span id="sun-points">100</span></p>
          <p></p>
          <button id="restartButton" style="display: none;">Restart</button>

          <!-- Pop-up pour afficher les informations -->
            <div id="infoModal" class="modal">
                <div class="modal-content">
                    <span id="closeButton" class="close">&times;</span>
                    <h2>Informations du Jeu</h2>
                    <p>Bienvenue dans ce jeu sur la protection de la barrière de corail! Voici quelques informations sur vos adversaires :</p>
                    <ul>
                        <li>La pêche à la dynamite: </li>
                        <li>La pêche à la dynamite est une méthode destructrice utilisée par certains pêcheurs pour capturer massivement des poissons. Elle consiste à exploser des charges sous l'eau, ce qui tue non seulement les poissons, mais cause aussi des dégâts irréparables aux coraux. Les explosions déchiquètent les structures fragiles des récifs coralliens, détruisant des milliers d'années de croissance. Ce type de pêche génère également des ondes de choc qui déstabilisent l'écosystème local, tuant des organismes marins et perturbant la biodiversité. En raison de sa violence, la pêche à la dynamite compromet la résilience des récifs coralliens, rendant ces derniers plus vulnérables aux autres menaces, comme le réchauffement des eaux.</li>
                        <li></li>
                        <li>Le rôle du poisson-perroquet:</li>
                        <li>Les poissons-perroquets jouent un rôle essentiel dans le maintien de la santé des récifs coralliens. Ils se nourrissent principalement d'algues qui envahissent les coraux, empêchant ainsi leur croissance et leur développement. En régulant la population d'algues, ces poissons contribuent à préserver l'équilibre du récif corallien. Toutefois, la surpêche du poisson-perroquet, souvent pratiquée pour leur chair ou dans le cadre du commerce de souvenirs, perturbe cette dynamique naturelle. Leur disparition entraîne une prolifération excessive d'algues, qui étouffent les coraux et entravent leur capacité à se régénérer.</li>
                        <li></li>
                        <li>Le réchauffement des eaux :</li>
                        <li>Le réchauffement des eaux océaniques est l'une des principales causes du blanchissement des coraux, un phénomène où les coraux perdent leur couleur vive et deviennent blancs. Ce stress thermique survient lorsque les températures de l'eau augmentent de manière anormale, provoquant la dégradation des symbioses entre les coraux et les micro-algues appelées zooxanthelles. Ces algues sont cruciales pour la photosynthèse et la nutrition des coraux. Lorsque les coraux sont soumis à des températures élevées, les zooxanthelles sont expulsées, privant les coraux de leur source de nourriture. Bien que certains coraux puissent se rétablir après des événements de blanchissement, des expositions prolongées au réchauffement des eaux peuvent entraîner la mort massive des récifs coralliens.</li>
                    </ul>
                    <p>Bon jeu!</p>
                </div>
            </div>
        </div>
      </div>
      <button id="infoButton">Informations</button>
    <script src="./ressources/scripts/scriptFoie.js"></script>
</body>
</html>