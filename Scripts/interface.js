
var scoreTotal = 0;
var score=1000;

var equateur_token = 0;
var green_token = 0;
var circle_token = 0;
var distance_token = 0;
var loca_token = 0;

// pour le sidebar dynamique rétractable
$("#menu-toggle").click(function(e){
	e.preventDefault();
	$("#wrapper").toggleClass("menuDisplayed");
});

//score 1000 debut, perd 1000 par essaie, 100 de plus par outil trait, 200 pour encercler 

//retire des points de score
function retire_pts(p){
	score = score - p;
}

//envoie le score total dans la page html
function scoreTot(){
	scoreTotal += score; 
	document.getElementById("scoreTotal").innerHTML = score;
}
//réinitialise le score à 1000 au début d'une question
function scoreReset(){
	score = 1000;
}

//retire des points lorsqu'une aide à été utilisé et actualise dans le html
function score_actu(){
	if(loca_token == 1){
		score = 0;
	}
	else{
		if(equateur_token == 1){
			retire_pts(100);
			equateur_token = -1;
		}
		if(green_token == 1){
			retire_pts(100);
			green_token = -1;
		}	
		if(circle_token == 1){
			retire_pts(200);
			circle_token = -1;
		}
	}

	document.getElementById("scoreA").innerHTML = score;
}

//réinitialise toutes les aides pour qu'ils soient réutilisable
function tok_reinit(){
	equateur_token = 0;
	green_token = 0;
	circle_token = 0;
	distance_token = 0;
	loca_token = 0;
}