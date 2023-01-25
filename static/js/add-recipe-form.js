var nbUtensils = 1;
function addUtensil() {
    nbUtensils++;
    var newElement = document.createElement('div');
    newElement.innerHTML = "<label for='utensil" + nbUtensils + "'>Ustensil " + nbUtensils + " :</label><br><input type='text' id='utensil" + nbUtensils + "' name='utensils[]" + nbUtensils + " required'><br><br>";
    container.appendChild(newElement);
}
var nbIngredients = 1;
function addIngredient() {

    nbIngredients++;
    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='ingredient" + nbIngredients + "'>Ingredient " + nbIngredients + " :</label><br><input type='text' id='ingredient" + nbIngredients + "' name='ingredients[]" + nbIngredients + " required'><br><br>";
    container2.appendChild(newElement);

    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='quantity" + nbIngredients + "'>Quantité " + nbIngredients + " :</label><br><input type='text' id='quantity" + nbIngredients + "' name='quantities[]" + nbIngredients + " required '><br><br>";
    container2.appendChild(newElement);

}


var nbParticularities = 1;
function addParticularity() {
    nbParticularities++;
    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='particulty" + nbParticularities + "'>Particularité " + nbParticularities + " :</label><br><input type='text' id='particularity" + nbParticularities + "' name='particularities[]" + nbParticularities + " required'><br><br>";
    container3.appendChild(newElement);
}