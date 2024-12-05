// S'assurer que le DOM est entièrement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', () => {
    // Sélection des éléments
    const menuButton = document.getElementById('menuButton');
    const menuContent = document.getElementById('menuContent');

    if (!menuButton || !menuContent) {
        console.error("MenuButton ou MenuContent n'existe pas dans le DOM.");
        return; // Arrête l'exécution si les éléments ne sont pas trouvés
    }

    // Gérer l'ouverture et la fermeture du menu
    menuButton.addEventListener('click', () => {
        const isMenuOpen = menuContent.style.transform === 'translateX(0%)';
        menuContent.style.transform = isMenuOpen ? 'translateX(-100%)' : 'translateX(0%)';
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('menuButton');
    const menuContent = document.getElementById('menuContent');
    const closeMenu = document.getElementById('closeMenu'); // Croix de fermeture

    if (!menuButton || !menuContent || !closeMenu) {
        console.error("MenuButton, MenuContent ou CloseMenu n'existe pas dans le DOM.");
        return; // Arrête l'exécution si les éléments ne sont pas trouvés
    }

    // Ouvrir le menu
    menuButton.addEventListener('click', () => {
        menuContent.style.transform = 'translateX(0%)';
    });

    // Fermer le menu en cliquant sur la croix
    closeMenu.addEventListener('click', () => {
        menuContent.style.transform = 'translateX(-100%)';
    });
});