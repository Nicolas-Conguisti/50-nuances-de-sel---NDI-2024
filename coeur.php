<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vogue et suis ta vie</title>
    <link rel="stylesheet" href="ressources/styles/style.css">
    <script src="ressources/scripts/scriptCoeur.js"></script>
</head>
<body>

    <?php
    include('ressources/components/header.php');
    ?>

    <div class="coeur">

        <section class="intro">
            <div class="container">            
                <h1>Les courants marins, le coeur de l'océan</h1>
                <p>L’eau des océans suit un cycle constant influencé par les différences de température et de densité. 
                    À l’équateur, sous l’effet du soleil, l’eau se réchauffe et se dilate, devenant moins dense. 
                    Elle se déplace alors vers les pôles, où elle rencontre des températures plus froides. 
                    En refroidissant, l’eau devient plus dense, s’enfonce dans les profondeurs océaniques et amorce son retour vers l’équateur. 
                    Ce processus, appelé circulation thermohaline, joue un rôle crucial dans la régulation de la température planétaire. 
                    En arrivant de nouveau à l’équateur, l’eau se réchauffe à nouveau, et le cycle recommence.</p>
            </div>
        </section>

        <section class="carte">
        
            <div class="container">

                <div class="colonnes">
                    <div class="colonne-1">
                        <div class="image">
                            <img class="sansCourant" src="./ressources/img/Hoelzelnaturalearth_2.png" alt="">
                            <img class="courant" src="./ressources/img/Hoelzelnaturalearth.png" alt="">
                            <img class="sel" src="./ressources/img/Hoelzelnaturalearth_3.png" alt="">
                        </div>
                    </div>

                    <div class="colonne-2">
                        <div class="btn">
                            Courant marin : 
                            <a href="#" onclick="courant()">
                                <img class="btnCourant" src="./ressources/img/btnON.png" alt="">
                            </a>
                        </div>
                        <div class="btn">
                            Eau salée : 
                            <a href="#" onclick="sel()">
                                <img class="btnSel" src="./ressources/img/btnON.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="explication">
            <div class="container">
                <h2>Les courants marins, le cœur des océans</h2>
                <p>
                    Les courants marins agissent comme un système cardiovasculaire pour la planète.
                    À l’image d’un cœur qui alimente les organes en sang, ils distribuent la chaleur, les nutriments et l’énergie à travers les océans. 
                    En régulant la température des eaux, ils assurent un équilibre thermique crucial pour la survie des écosystèmes marins et terrestres. 
                    Ces flux influencent directement les conditions météorologiques et climatiques sur les continents voisins. 
                    Sans ces courants, la planète subirait des déséquilibres thermiques extrêmes, menaçant de nombreux habitats. 
                    Leur continuité est donc essentielle à l’harmonie environnementale mondiale.
                </p>

                <h2>Impact climatique de la disparition des courants</h2>
                <p>
                    La disparition ou l’affaiblissement des courants marins aurait des répercussions dévastatrices sur le climat mondial. 
                    En interrompant la circulation des eaux chaudes et froides, des anomalies climatiques pourraient survenir, comme des sécheresses prolongées ou des inondations extrêmes. 
                    Certaines espèces animales, dépendantes de conditions climatiques stables, pourraient voir leur habitat changer radicalement, menaçant leur survie. 
                    Par exemple, des espèces polaires comme les phoques et les ours polaires pourraient perdre leur territoire à cause de la fonte des glaces exacerbée. 
                    Ces perturbations climatiques témoignent de la sensibilité du climat face à la régulation océanique.
                </p>

                <h2>La salinisation des océans en danger</h2>
                <p>
                    Les courants marins jouent un rôle crucial dans le mélange des eaux salées et douces. Leur interruption pourrait entraîner des déséquilibres dans la salinité des océans, avec des impacts considérables sur la biodiversité marine. Dans les zones où l’eau ne circule plus correctement, la salinité pourrait augmenter, rendant certaines régions inhabitables pour des espèces marines sensibles. À l’inverse, dans d’autres zones, la dilution excessive de l’eau salée pourrait perturber les écosystèmes établis. Ces modifications compromettent également des activités humaines comme la pêche, qui dépend d’un équilibre stable pour maintenir les populations de poissons.
                </p>

                <h2>L’impact de l’activité humaine sur les courants marins</h2>
                <p>
                    L’activité humaine exerce une pression croissante sur les courants marins, perturbant leur fonctionnement naturel. 
                    Le réchauffement climatique, provoqué par les émissions de gaz à effet de serre, modifie les températures des eaux de surface et des profondeurs. 
                    De plus, la pollution plastique, les déversements de pétrole et l’exploitation excessive des ressources marines contribuent à l’altération des courants. 
                    Ces perturbations menacent la circulation thermohaline, essentielle à la régulation climatique et océanique. 
                    Il devient impératif de réduire notre impact sur les océans pour préserver leur rôle vital dans le maintien de l’équilibre écologique de la planète.
                </p>
            </div>
        </section>

    </div>
</body>
</html>

