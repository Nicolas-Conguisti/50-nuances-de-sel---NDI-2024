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

    <div class="coeur">
        
        <div class="container">

        
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
            
            <div class="image">
                <img class="sansCourant" src="./ressources/img/Hoelzelnaturalearth_2.png" alt="">
                <img class="courant" src="./ressources/img/Hoelzelnaturalearth.png" alt="">
                <img class="sel" src="./ressources/img/Hoelzelnaturalearth_3.png" alt="">
            </div>


        </div>

    </div>
</body>
</html>

<script>
    // Initialisation
    var imgCourant = document.querySelector('.courant');
    var imgSansCourant = document.querySelector('.sansCourant');
    var imgSel = document.querySelector('.sel');
    var btnCourant = document.querySelector('.btnCourant');
    var btnSel = document.querySelector('.btnSel');

    // Assure que les états de départ sont définis correctement
    imgCourant.hidden = false;
    imgSansCourant.hidden = true;
    imgSel.hidden = false;

    function courant() {
        if (!imgCourant.hidden) {
            imgCourant.hidden = true;
            imgSansCourant.hidden = false;
            btnCourant.src="./ressources/img/btnOFF.png";
        } else {
            imgCourant.hidden = false;
            imgSansCourant.hidden = true;
            btnCourant.src="./ressources/img/btnON.png";
        }
    }

    function sel() {
        if (!imgSel.hidden) {
            imgSel.hidden = true;
            btnSel.src="./ressources/img/btnOFF.png"
        } else{
            imgSel.hidden = false;
            btnSel.src="./ressources/img/btnON.png"
        }
    }

</script>

<style>
    .coeur a{
        position: relative;
        display: block;
        width: 50px;
    }

    .coeur .container{
        margin: auto;
        padding: 0px 20px;
        max-width: 1300px
    }

    .coeur img{
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .coeur div.image img{
        position: absolute;
    }

    .coeur div.image{
        width: 600px;
        position: relative;
    }
</style>