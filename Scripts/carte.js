
// bornes pour empecher la carte StamenWatercolor de "dériver" trop loin...
var northWest = L.latLng(90, -180);
var southEast = L.latLng(-90, 180);
var bornes = L.latLngBounds(northWest, southEast);

let paysDonnees = "Data/countries.json"
let paysData = {};
let worldData = {};
let pays_cca3, paysNom, contour;

let paysGeo = '.geo.json';
let paysDir ="Data/paysGeo/"
let drapDir ="Data/drapeauSVG/"
let coord = [];
var worldURL = "Data/countries.geojson";

var validation = -1;
var Click_fail = 0;

// Initialisation de la couche StamenWatercolor
var coucheStamenWatercolor = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    subdomains: 'abcd',
    ext: 'jpg',
    opacity: 1
});
// Initialisation de la carte et association avec la div
var map = new L.Map('maDiv', {
    center: [42.858376, 2.294442],
    minZoom: 2,
    maxZoom: 18,
    zoom: 2,
    maxBounds: bornes
});
// Initilisation d'un popup
var popup = L.popup();
// Récupère les polygones du fichier countries.geojson
function recupWorld() {
    fetch(worldURL)
    .then(function(res) {
        return res.json();
    })
    .then(function(data) {
        contourWorld(data);
    })
}
//contour des pays du monde par une fonction fetch ajax permetant de créer une couche pour identifier les clics ratés
function contourWorld(w) {
    var Cmonde = L.geoJSON(w, {
        style : function(feature) {
            return {
                color : "#6E320F",
                fillOpacity: 0,
                weight:1
                }
        },
        onEachFeature: function (feature, layer) {
            layer.on('click', function (e) {
                if(distance_token != 1){

                    Click_fail++;
                    if(Click_fail == 1){
                    attempt1();
                    }
                    if(Click_fail == 2){
                    attempt2();
                    }
                    if(Click_fail == 3){
                        console.log("lost!");
                        score = 0;
                        Click_fail = 0;
                        validation = 1;
                        map.removeLayer(contour); // retrait du layer du pays d'avant
                        remove_circle();
                        boucle();
                        reload_attempt();
                        scoreReset();
                        
                    }
                    
                }
            });
        }
    }).addTo(map);
    
}


// Juste pour changer la forme du curseur par défaut de la souris
document.getElementById('maDiv').style.cursor = 'crosshair'
//map.fitBounds(bornes);


// Fonction de conversion au format GeoJSON
function coordGeoJSON(latlng,precision) { 
    return '[' +
    L.Util.formatNum(latlng.lng, precision) + ',' +
    L.Util.formatNum(latlng.lat, precision) + ']';
}

// Association Evenement/Fonction handler
//map.on('click', onMapClick);



// Contour du pays à trouver, on pose une couche cliquable invisible
function contourP(cca3) {
    fetch(paysDir+cca3+paysGeo)
        .then( res => res.json())
        .then(function(data) {
            contour =  L.geoJson(data, {
                style : function(feature) {//a retirer ver finale
                    return {
                        color : "green",
                        fillOpacity: 0,
                        opacity: 0,
                        width: 10
                    }
                },
            onEachFeature: function (feature, layer) {
                layer.on('click', function (e) {// Quand pays est trouvé
                    map.removeLayer(contour);
                    remove_circle();
                    remove_cardinal();
                    console.log("hello");
                    validation =1;
                    boucle();
                    reload_attempt();
                    scoreReset();
                });
            }
            }).addTo(map)
        })
}

//permet de révéler le pays à trouver sans bloquer 
function contourP_rev(cca3) {
    fetch(paysDir+cca3+paysGeo)
        .then( res => res.json())
        .then(function(data) {
            contour =  L.geoJson(data, {
                style : function(feature) {
                    return {
                        color : "green",
                        opacity: 1,
                        width: 20
                    }
                }
            }).addTo(map)
        })
}

//Récupère toutes les données de countries.geojson dans paysData
function numPays(num){
    for(let prop in paysData) {
        if(prop == (num-1)) { // -1 car base de donnée sql commence a 1 
            pays_cca3 = (paysData[prop].cca3).toLowerCase();
            paysNom = paysData[prop].translations.fra.common;
            coord = paysData[prop].latlng;
            
        }
    }
}

//Boucle principale du jeu
function boucle() {
    if(cpt != 0 && cpt < 5){
        scoreTotal += score;
        tok_reinit();

    }
    compteur(); // cpt
    if(cpt <=5 && validation != 0){
    cp = cpt;
    document.getElementById("scoreTotal").innerHTML = scoreTotal;
    fetch(paysDonnees)
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {
                paysData = data;
                numPays(gen_nums[cpt-1]);
                affPays(paysNom);
                contourP(pays_cca3);
                aff_drap(pays_cca3);
                validation = 0;
                score_actu();
                  
            })
    }
    if (cpt == 6){ // derniere action avant de sortir
        console.log("fini");
        scoreTotal += score;
        document.getElementById("scoreTotal").innerHTML = scoreTotal;
        alert("Votre score total est de : " + scoreTotal);
        window.location.href = "endgame.php?score="+scoreTotal+"&tab="+gen_nums;

    }

}


//réaction lorqu'on clique sur la carte avec le mode distane activé
map.on('click', function(e) {
    if(distance_token == 1){
        let distance = cdist(e);
        modeDistance(distance);
        popup.setLatLng(e.latlng)
            .setContent(paysNom+"<br/> se situe à " +distance + " km d'ici<br/> Score : +"+ score)
            .openOn(map);

        
        // procédure de passage au prochain
        map.removeLayer(contour);
        remove_circle();
        remove_cardinal();
        validation =1;
        boucle();
        reload_attempt();
        scoreReset();
        

        distance_token = 0;

    } 
});

//permet de récupérer les coordonnées de la souris en "direct"
function mousemove(){
    map.on('mousemove', function(e) {
        document.getElementById("coordx").innerHTML = e.latlng.lat.toFixed(1);
        document.getElementById("coordy").innerHTML = e.latlng.lng.toFixed(1);
    
    });
}

//boucle pour révéler les pays à trouver, dans la correction
  function boucle_reveal() {
    compteur(); // cpt
    if(cpt <=5){
    cp = cpt;
    fetch(paysDonnees)
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {
                paysData = data;
                numPays(gen_nums[cpt-1]);
                affPays(paysNom);
                contourP_rev(pays_cca3);
                aff_drap(pays_cca3);
                affwiki(cp);
                localiser_rev(cp);
                boucle_reveal(); 
            })
    }
    if (cpt == 6){ // derniere action avant de sortir
        console.log("fini");
        affwiki();
    }
}

//permet de régler la vue d'un continent au début de la partie 
function setV(continent){
    if(continent == 1){//europe
        map.setView([50, 14], 4);
    }
    if(continent == 2){//amerique
        map.setView([25, -80], 3);
    }
    if(continent == 3){//Asie
        map.setView([53, 95], 3);
    }
    if(continent == 4){//oceanie
        map.setView([-18, 125], 3);
    }
    if(continent == 5){//afrique
        map.setView([10, 20], 3);
    }
}