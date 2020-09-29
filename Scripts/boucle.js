// Execute quand page chargée
window.addEventListener('load', function () {
    // Affichage de la carte
    map.addLayer(coucheStamenWatercolor);
    L.control.scale().addTo(map);
    recupWorld();// affiche les frontieres
    mousemove();
    gentab(iteration, tab_gen);
    setV(continent); // lance une partie normale
    setTimeout(function(){ // recup world prend plus de temps
        boucle();
    }, 1000);

})