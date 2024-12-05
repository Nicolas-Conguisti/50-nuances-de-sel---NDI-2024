
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
