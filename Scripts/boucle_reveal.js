// Execute quand page chargée
window.addEventListener('load', function () {
    // Affichage de la carte
    map.addLayer(coucheStamenWatercolor);
    L.control.scale().addTo(map);
    recupWorld();// affiche les frontieres
    mousemove();
    gentab(iteration, tab_gen);
    boucle_reveal();


})