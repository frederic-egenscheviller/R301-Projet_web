var nbUtensils = 1;
function addUtensil() {
    nbUtensils++;
    var newElement = document.createElement('div');
    newElement.innerHTML = "<label for='utensil" + nbUtensils + "'>Ustensil " + nbUtensils + " :</label><br><input type='text' id='utensil" + nbUtensils + "' name='utensils[] required'><br><br>";
    container.appendChild(newElement);
}
var nbIngredients = 1;
function addIngredient() {
    nbIngredients++;
    var ingredient = document.createElement("div");
    ingredient.innerHTML = "<label for='input" + nbIngredients + "'>Ingredient " + nbIngredients + " :</label><br><input type='text' id='input" + nbIngredients + "' name='ingredients[]'><br><br>";
    var quantity = document.createElement("div");
    quantity.innerHTML = "<label>Quantity " + nbIngredients + " :</label><br><input type='text' id='input" + nbIngredients + "' name='quantities[]'><br><br>";
    container2.appendChild(ingredient);
    container2.appendChild(quantity);
}


var nbParticularities = 1;
function addParticularity() {
    nbParticularities++;
    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='particulty" + nbParticularities + "'>Particularité " + nbParticularities + " :</label><br><input type='text' id='particularity" + nbParticularities + "' name='particularities[]'  required'><br><br>";
    container3.appendChild(newElement);
}