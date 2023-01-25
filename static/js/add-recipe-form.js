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
<<<<<<< HEAD
    var ingredient = document.createElement("div");
    ingredient.innerHTML = "<label for='input" + nbIngredients + "'>Ingredient " + nbIngredients + " :</label><br><input type='text' id='input" + nbIngredients + "' name='input" + nbIngredients + "'><br><br>";
    var quantity = document.createElement("div");
    quantity.innerHTML = "<label>Quantity " + nbIngredients + " :</label><br><input type='text' id='input" + nbIngredients + "' name='input" + nbIngredients + "'><br><br>";
    container2.appendChild(ingredient);
    container2.appendChild(quantity);
=======
    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='ingredient" + nbIngredients + "'>Ingredient " + nbIngredients + " :</label><br><input type='text' id='ingredient" + nbIngredients + "' name='ingredients[]" + nbIngredients + " required'><br><br>";
    container2.appendChild(newElement);

    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='quantity" + nbIngredients + "'>Quantité " + nbIngredients + " :</label><br><input type='text' id='quantity" + nbIngredients + "' name='quantities[]" + nbIngredients + " required '><br><br>";
    container2.appendChild(newElement);
>>>>>>> ff710a7c92c40e7a0f7e36f679e276ce39e46cab

}


var nbParticularities = 1;
function addParticularity() {
    nbParticularities++;
    var newElement = document.createElement("div");
    newElement.innerHTML = "<label for='particulty" + nbParticularities + "'>Particularité " + nbParticularities + " :</label><br><input type='text' id='particularity" + nbParticularities + "' name='particularities[]" + nbParticularities + " required'><br><br>";
    container3.appendChild(newElement);
}