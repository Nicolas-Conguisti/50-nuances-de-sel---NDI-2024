<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Météo</title>
    <style>
        /* Styles généraux */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #1e90ff, #87cefa); /* Bleu ciel vers bleu clair */
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-attachment: fixed; /* Effet fluide */
        }

        /* Conteneur principal */
        .promo-container {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* Fond blanc semi-transparent */
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
        }

        /* Titre */
        .promo-container h1 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #1e90ff; /* Bleu océan */
            font-weight: bold;
        }

        /* Texte descriptif */
        .promo-container p {
            font-size: 16px;
            margin: 10px 0;
            color: #333; /* Couleur du texte dans le conteneur */
        }

        /* QR code */
        .qr-code img {
            max-width: 200px;
            width: 100%;
            height: auto;
            margin: 20px 0;
            border: 2px solid #1e90ff; /* Cadre bleu océan */
            border-radius: 10px;
        }

        /* Texte de l'appel à l'action */
        .cta-text {
            font-size: 14px;
            font-weight: bold;
            color: #1e90ff; /* Bleu océan */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="promo-container">
        <h1>Plongez dans la météo</h1>
        <p>Découvrez des prévisions précises et fiables pour vos journées ensoleillées ou nuageuses. Téléchargez notre application maintenant :</p>
        <div class="qr-code">
            <!-- Remplacez "qr-code.png" par l'image de votre QR code -->
            <img src="./ressources/img/qrcode.jpeg" alt="QR code pour télécharger l'application">
        </div>
        <p class="cta-text">Scannez ce QR code pour plonger dans l'univers de la météo !</p>
    </div>
</body>
</html>