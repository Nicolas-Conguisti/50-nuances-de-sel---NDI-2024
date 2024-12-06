<?php
// Configuration de base
$titre = "La peau et la Banquise";
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page explicitant le lien entre la peau et la banquise.">
    <meta name="author" content="LAVERGNE Elsa aka PÉPITO">
    <!-- Lien vers des fichiers CSS -->
    <link rel="stylesheet" href="./ressources/styles/style.css">
    <style>
       
    </style>
</head>

<body>
    <header>
        <?php include('./ressources/components/header.php'); ?>
    </header>

    <main >
        <section class="paragraphesPeau">
        <h2>La peau</h2>
        <p>La peau a beaucoup d'utilités et celle qui nous intéresse principalement pour notre comparaison est son abilité à gérer notre température.<br>
        La peau, entre autre, nous évite de complètement fondre de l'intérieur en prenant une douche chaude, après un effort physique, à côté d'un chauffage etc...
        </p>
        <h2>La banquise</h2>
        <p>Maintenant, la banquise : Depuis 1970, on a perdu 13.1% de notre banquise.<br>
        Beaucoup pensent que la fonte de la banquise fait monter le niveau des océans : Non.<br>
        EN REVANCHE, la banquise a une albédo très proche de 1 (la qualifiant par conséquent de surface miroitante). Cela fait donc qu'une grande majorité des rayons solaires sont reflétés par la banquise.</br>
        Ainsi, on se retrouve avec moins de banquise, donc moins de réflexion des rayons pour que les océans, eux, surface non miroitante, les absorbent.<br>
    Si l'océan est notre corps, alors sans sa peau (=la banquise), il absorbe la chaleur, va se réchauffer, va devenir plus acide et va se détériorer.</p>
        </section>

        
        <section class="paragraphesPeau">
            <p>Sur une autre note....</p>
            <h2>Bienvenue sur le jeu de l'Ours Polaire</h2>
            <p>
                Aidez l'ours polaire à éviter les trous sur la banquise en sautant ! <br>
                Lui aussi vit très mal la fonte de la banquise !!!<br>
                Appuyez sur **Espace** pour sauter lorsque le jeu commence.
            </p>

            <div id="jeuPolaire">
                <div id="score">Score : 0</div>
                <button id="startGameButton">Lancer le jeu</button>
                <canvas id="gameCanvas" width="800" height="400"></canvas>
            </div>

        </section>
    </main>

    <script src="./ressources/scripts/scriptPeau.js"></script>
</body>

</html>
