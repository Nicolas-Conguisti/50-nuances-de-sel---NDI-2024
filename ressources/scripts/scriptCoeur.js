document.addEventListener("DOMContentLoaded", () => {
    console.log("Script chargé avec succès.");

    // Sélection des éléments
    const imgCourant = document.querySelector('.courant');
    const imgSansCourant = document.querySelector('.sansCourant');
    const imgSel = document.querySelector('.sel');
    const btnCourant = document.getElementById('btnCourant').querySelector('img');
    const btnSel = document.getElementById('btnSel').querySelector('img');

    // Initialisation des états
    imgCourant.hidden = false;
    imgSansCourant.hidden = true;
    imgSel.hidden = false;

    // Fonction pour gérer les courants marins
    const toggleCourant = () => {
        const isCourantVisible = !imgCourant.hidden;
        imgCourant.hidden = isCourantVisible;
        imgSansCourant.hidden = !isCourantVisible;
        btnCourant.src = isCourantVisible ? "./ressources/img/btnOFF.png" : "./ressources/img/btnON.png";
    };

    // Fonction pour gérer l'affichage de la salinité
    const toggleSel = () => {
        const isSelVisible = !imgSel.hidden;
        imgSel.hidden = isSelVisible;
        btnSel.src = isSelVisible ? "./ressources/img/btnOFF.png" : "./ressources/img/btnON.png";
    };

    // Ajout des écouteurs d'événements
    document.getElementById('btnCourant').addEventListener('click', toggleCourant);
    document.getElementById('btnSel').addEventListener('click', toggleSel);
});