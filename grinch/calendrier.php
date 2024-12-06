<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les 24 jours de Décembre</title>
    <style>
        img {
            padding: 10px;
            margin: 5px;
            width: 120px;
            height: 120px;
            cursor: pointer;
        }
        .enabled {
            border: 5px solid #4CAF50; /* Bordure verte */
        }
        .disabled {
            border: 5px solid #f44336; /* Bordure rouge */
        }

        .jour-container {
            display: inline-block;
            text-align: center;
            margin: 10px;
            width: 10%;
        }

        a img {
            display: block;
            width: 100%;
            height: auto;
        }

        div.grinch {
            position: absolute;
            width: 15%;
            top: 0;
            left: 0;
            display: none;
            transition: all 2s ease;
        }

        div.fumee {
            position: absolute;
            width: 15%;
            top: 0;
            left: 0;
            display: none;
        }

        div.container {
            margin: auto;
            padding: 0px 50px;
            max-width: 1300px;
        }
    </style>
</head>
<body>
    <h1>Les 24 jours de Décembre</h1>
    <div class="container">
        <form id="form" method="POST" action="">
            <?php
            $files = scandir("images/imgCadeau");

            // Initialiser un tableau pour stocker les fichiers
            $fileList = [];

            // Fonction pour obtenir l'extension du fichier
            function getFileExtension($filename) {
                return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            }

            // Boucler à travers les résultats de scandir()
            foreach ($files as $file) {
                // Ignorer les répertoires spéciaux . et ..
                if ($file !== '.' && $file !== '..') {
                    // Vérifier si c'est un fichier et non un répertoire
                    if (is_file("images/imgCadeau/" . $file)) {
                        $fileExtension = getFileExtension($file);

                        // Ajouter seulement les fichiers avec les extensions valides
                        if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif', 'mp4', 'mp3', 'pdf'])) {
                            $fileList[] = [
                                'filename' => $file,
                                'extension' => $fileExtension
                            ];
                        }
                    }
                }
            }

            // Générer les 24 jours de décembre
            $jours_decembre = range(1, 24);
            foreach ($jours_decembre as $jour) {
                $date_jour = date('Y-m-d', strtotime("2024-12-" . str_pad($jour, 2, '0', STR_PAD_LEFT)));
                $is_today = $date_jour == date('Y-m-d');
                $image_src = "images/cadeauFerme.png";

                // Vérifier si on a assez de fichiers
                if (isset($fileList[$jour - 1])) {
                    $file = $fileList[$jour - 1];
                    $filePath = "images/imgCadeau/" . $file['filename'];
                    $fileExtension = $file['extension'];
                } else {
                    $filePath = "images/cadeauFerme.png"; // Par défaut, cadeau fermé
                    $fileExtension = 'png'; // Extension par défaut
                }

                echo '<div class="jour-container">';
                echo '<p class="jourCalendrier">' . $jour . '</p>';
                echo '<a id="' . $jour . '" onclick="handleClick(' . $jour . ', this, event)">';

                // Vérifier l'extension et afficher le bon élément
                if ($fileExtension == 'mp3') {
                    // Si c'est un fichier mp3, afficher un lecteur audio
                    echo '<img class="cadeau-img" src="' . $image_src . '" alt="Jour ' . $jour . '">';
                    echo '<audio style="display:none;" controls><source src="' . $filePath . '" type="audio/mpeg">Votre navigateur ne supporte pas l\'élément audio.</audio>';
                } elseif ($fileExtension == 'mp4') {
                    // Si c'est un fichier mp4, afficher un lecteur vidéo
                    echo '<img class="cadeau-img" src="' . $image_src . '" alt="Jour ' . $jour . '">';
                    echo '<video style="display:none;" width="320" height="240" controls><source src="' . $filePath . '" type="video/mp4">Votre navigateur ne supporte pas l\'élément vidéo.</video>';
                } elseif ($fileExtension == 'pdf') {
                    // Si c'est un fichier pdf, afficher un lien
                    echo '<img class="cadeau-img" src="' . $image_src . '" alt="Jour ' . $jour . '">
                          </a>';
                    echo '<a class="PDF_Cal" style="display:none;" href="' . $filePath . '" target="_blank">Télécharger le PDF</a>';
                } else {
                    // Si c'est une image, afficher l'image
                    echo '<img class="cadeau-img" src="' . $image_src . '" alt="Jour ' . $jour . '">';
                    echo '<img style="display:none;" class="jour-img" src="' . $filePath . '" alt="Image du jour ' . $jour . '">';
                }

                echo '</a>';
                echo '</div>';
            }
            ?>
        </form>
    </div>

    <div class="grinch">
        <img class="grinch" src="./images/grinch.png" alt="Grinch">
    </div>
    <div class="fumee">
        <img class="fumee" src="./images/fumee.webp" alt="Fumée">
    </div>
    
    <script>
        function handleClick(jour, bouton, event) {
            event.preventDefault();  // Empêche le rechargement de la page

            var dateActuelle = new Date();
            var annee = dateActuelle.getFullYear();
            var mois = dateActuelle.getMonth() + 1;
            var jourActuel = dateActuelle.getDate();

            mois = mois < 10 ? '0' + mois : mois;
            jourActuel = jourActuel < 10 ? '0' + jourActuel : jourActuel;
            var dateDuJour = annee + '-' + mois + '-' + jourActuel;

            // Si la date actuelle est égale ou après la date du jour actuel
            if (dateDuJour >= '2024-12-' + (jour < 10 ? '0' + jour : jour)) {
                // Change l'image du cadeau
                bouton.querySelector('.cadeau-img').src = "images/cadeauOuvert.png";
                setTimeout(function () {
                    bouton.querySelector('.cadeau-img').style.display = "none";
                    console.log(bouton.querySelector('.cadeau-img').nextSibling)
                    bouton.querySelector('.cadeau-img').nextSibling.style.display="block"
                    if(bouton.querySelector('.cadeau-img').nextElementSibling == null){
                        bouton.hidden = true;
                        bouton.querySelector('.cadeau-img').parentElement.nextElementSibling.style.display ="block";
                    }
                }, 2000)
                // Vous pouvez aussi ajouter un effet ou une animation ici
            }

        }

        // Gestion de l'animation du Grinch
        function retourGrinch() {
            let grinch = document.querySelector('div.grinch');
            let jour = new Date().getDate();
            let fumee = document.querySelector('div.fumee');
            var cadeauVole = document.getElementById(jour);
            
            cadeauVole.querySelector('.cadeau-img').src = "images/cadeauVole.png";
            grinch.style.display = "block";
            grinch.style.transform = "translate(0px, 0px)";
            
            setTimeout(function () {
                grinch.style.display = "none";
                fumee.style.display = "block";
                setTimeout(function () {
                    fumee.style.display = "none";
                }, 2000);
            }, 2000);
        }

        function getRandomNumber(min, max) {
            let randomNumber = 10; 
            let grinch = document.querySelector('div.grinch');
            let rireGrinch = new Audio('Riregrinch.mp3');

            let jour = new Date().getDate();
            if (randomNumber === 10) {
                grinch.style.display = "block";
                rireGrinch.play();
                var cadeauVole = document.getElementById(jour);
                var coord = cadeauVole.getBoundingClientRect();
                var transform = "translate(" + coord.top + "px, " + (coord.right - coord.width) + "px)";
                grinch.style.transform = transform;

                setTimeout(retourGrinch, 5000);
            }
        }

        addEventListener("DOMContentLoaded", (event) => {
            getRandomNumber();
        });
    </script>
</body>
</html>
