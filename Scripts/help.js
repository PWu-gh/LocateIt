var r_coord = [];
var circle, cardinal, cardinal2;

//Affichage du nombre de tentative en changeant l'opacité des images 
function attempt1(){
	document.getElementById("try1").style.opacity = 0.2;
}

function attempt2(){
    document.getElementById("try1").style.opacity = 0.2;
	document.getElementById("try2").style.opacity = 0.2;
}

function attempt3(){
    document.getElementById("try1").style.opacity = 0.2;
	document.getElementById("try2").style.opacity = 0.2;
	document.getElementById("try3").style.opacity = 0.2;
}

function reload_attempt(){
	document.getElementById("try1").style.opacity = 1;
	document.getElementById("try2").style.opacity = 1;
	document.getElementById("try3").style.opacity = 1;

}




// EQUATEUR

//dessine un polygone pour couvrir la partie où le pays n'est pas présent
function equateur_cover_nord(){
    cardinal = L.polygon([[0,-200],[200,-200],[200,200],[0,200]], {
        color: 'black',
        fillColor: 'black',
        fillOpacity: 0.9
    }).addTo(map);
}

//dessine un polygone pour couvrir la partie où le pays n'est pas présent
function equateur_cover_sud(){
    cardinal = L.polygon([[0,-200],[-200,-200],[-200,200],[0,200]], {
        color: 'black',
        fillColor: 'black',
        fillOpacity: 0.9
    }).addTo(map);
}

//Vérifie si le pays à trouver se trouve au nord ou au sud
function check_ns(){
    if(equateur_token == 0){
        if(coord[0]<=0){
            equateur_cover_nord();
        }
        else{
            equateur_cover_sud();
        }
        equateur_token = 1;
        score_actu();
    }
    
    
}

// GREENWICH
//dessine un polygone pour couvrir la partie où le pays n'est pas présent
function green_cover_est(){
    cardinal2 = L.polygon([[200,0],[200,200],[-200,200],[-200,0]], {
        color: 'black',
        fillColor: 'black',
        fillOpacity: 0.9
    }).addTo(map);
    
}

//dessine un polygone pour couvrir la partie où le pays n'est pas présent
function green_cover_ouest(){
    cardinal2 = L.polygon([[200,0],[200,-200],[-200,-200],[-200,0]], {
        color: 'black',
        fillColor: 'black',
        fillOpacity: 0.9
    }).addTo(map);    
}

//Vérifie si le pays à trouver se trouve à l'est ou à l'ouest
function check_eo(){
    if(green_token == 0){
        if(coord[1]<=0){
            green_cover_est();
        }
        else{
            green_cover_ouest();
        }
        green_token = 1;
        score_actu();
    }
}

// ENCERCLER

//trouve un nombre aléatoire pour avoir un encerclement aléatoire
function getRandomInt_negative(max) {
    return (Math.floor(Math.random() * Math.floor(max)))*
    (Math.round(Math.random()) * 2 - 1);
}

//dessine un cercle non interactif sur la carte
function circle_rand(){
    if(circle_token == 0){
        r_coord = [coord[0]+getRandomInt_negative(17),coord[1]+getRandomInt_negative(25)];
        map.setView(r_coord,3);
        circle = L.circle(r_coord, {
            color: 'red',
            fillOpacity: 0,
            radius: 3000000,
            interactive:false
        }).addTo(map);
    
        circle_token =1;
        score_actu();
    }
   
}

//retire les polygones liées à (nord sud est ouest) 
function remove_cardinal(){
    if(map.hasLayer(cardinal)){
        map.removeLayer(cardinal);
    }
    if(map.hasLayer(cardinal2)){
        map.removeLayer(cardinal2);
    }
}

//retire le cercle
function remove_circle(){
    if(map.hasLayer(circle)){
        map.removeLayer(circle);
    }
}

//Click Distance permet de passer en mode distance
function activ_dist(){
    if(distance_token == 0){
        distance_token = 1;
        score_actu();
    }
}

// Calcule distance entre deux coordonnées 
function cdist(e){
   let from = e.latlng;
   let to = coord;
   return (from.distanceTo(to)/1000).toFixed(0);
}

// Evalue le joueur sur la proximité avec le pays à trouver (en km)
function modeDistance(distance){
    if(distance < 200){//proche 100%
        score = 900;
    }
    else if(distance < 500){//proche
        score = 800;
    }
    else if(distance < 1000){//assez proche
        score = 650;
    }
    else if(distance < 2000){//assez proche
        score = 500;
    }
    else if(distance < 5000){//trop loin, 0 points
        score = 250;
    }
    else{
        score = 0;
    }
    return score;
}


//permet de localiser le pays à trouver
function localiser(){
    if(loca_token == 0){
        loca_token = 1;
        score_actu();
        contour.setStyle({opacity:1, fillOpacity:1 });
        map.setView(coord,4);
        popup.setLatLng(coord)
        .setContent(paysNom+ "<br/>[" + coord.toString()+"]")
        .openOn(map);
    }
}

//permet de localiser le pays à trouver avec le popup qui ne disparait pas
function localiser_rev(newpop){
    var newpop = L.popup({
        closeOnClick: false,
        autoClose: false
      }).setLatLng(coord)
      .setContent(paysNom+ "<br/>[" + coord.toString()+"]")
      .openOn(map)
      .bindPopup(newpop);

}
