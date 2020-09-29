
let gen_nums = [];
let tab_wi = [];
let iteration = 5;
//var rand = getRandomInt(nbPays+1);
var cpt = 0;


// permet d'afficher une image en html avec le chemin de l'image
function aff_drap(pays_cca3){
    let image = document.getElementById('svg'+ cpt)
    image.src = drapDir+pays_cca3+".svg"
}

//permet d'afficher le nom du pays
function affPays(p){
    document.getElementById("paysNom"+ cpt).innerHTML = p;
}

//permet d'afficher les contenus wikipédia a un id wiki+n
function affwiki(cp){//tab_wiki[gen_nums[cpt-1]-1]
    if(cp  != 1){
        var x = document.getElementById("wiki"+ (cpt-1));
        x.data = tab_wiki[gen_nums[cpt-2]-1];
    }
    

}

//permet de générer un nombre au hasard
function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
  }

//permet de vérifier si l'argument el est présent dans le tableau
 function in_array(array, el) {
    for(var i = 0 ; i < array.length; i++) 
        if(array[i] == el) return true;
    return false;
 }
 
 //permet de récupérer une case au hasard de la table et de l'ajouter à la table gen_nums
 function get_rand(array) {
     var rand = array[Math.floor(Math.random()*array.length)];//valeur au hasard de la table
     
     if(!in_array(gen_nums, rand)) {
        gen_nums.push(rand); 
        return rand;
     }
     return get_rand(array);
 }


 //permet de générer une table de longueur itération à partir d'une table existante
 function gentab(iteration, randA){
    for(var i = 0; i < iteration; i++) {
        get_rand(randA);

     }
 }

//fonction pour incrémenter le compteur principal du jeu
function compteur(){
    cpt = cpt+1;
    return cpt;
}

