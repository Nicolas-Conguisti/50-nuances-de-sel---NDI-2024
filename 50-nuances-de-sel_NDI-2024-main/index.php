<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vogue et suis ta vie</title>
    <link rel="stylesheet" href="ressources/styles/style.css">
</head>
<body>

    <?php
    include('ressources/components/header.php');
    ?>


    <main id="main">

        <section id="intro">
            <h1 id="titre">
                Nuit de l'info 2024 !
            </h1>
            <p id="descriNDI">
                Pour cette édition de la nuit de l'info 2024, la protection des océans est mise à l'honneur ! <br>
                L'objectif est de créer une application éducative pour sensibiliser les gens à la proction des océans.
            </p>
            <article id="equipe">
                <div id="imageEquipe">
                    <img src="ressources/img/photo_group.png" alt="Photo de l'équipe" id="photoImageEquipe">
                </div>
                <p id="descriEquipe">
                    Nous sommes l'équipe " 50 nuances de sel ! ", des étudiants de l'IUT de Bayonne
                    prêts à saler cette édition de la nuit de l'info. 
                </p>
            </article>

        </section>

        <article id="partieCorps">

            <div id="corps">
                <img class="squelette" src="ressources/img/squelette.png" alt="Squelette du corps humain">

                <a class="organe coeur" href="coeur.php">
                    <img src="ressources/img/organes/coeur.png" alt="coeur humain">
                </a>
                <a class="organe foie" href="foie.php">
                    <img src="ressources/img/organes/foie.png" alt="foie humain">
                </a>
                <a class="organe poumon" href="poumon.php">
                    <img  src="ressources/img/organes/poumon.png" alt="poumon humain">
                </a>
                
                

            </div>

        </article>

    </main>

    <footer id="footer">

    </footer>
    
</body>
</html>