<?php
session_start();

// Vérifier si le score est bien envoyé via la requête POST
if (isset($_POST['score'])) {
    $score = intval($_POST['score']); // Récupérer le score envoyé par AJAX

    // Enregistrer le score dans la session
    $_SESSION['score'] = $score;

    // Retourner un message de succès avec le score mis à jour
    echo "Score mis à jour : " . $_SESSION['score'];
} else {
    // Si aucune donnée n'a été envoyée, retourner un message d'erreur
    echo "Aucun score reçu";
}
?>
