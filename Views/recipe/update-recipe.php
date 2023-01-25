<?php

function addInputRadio($A_view, $name, $value) {
    echo "<label>$value</label>
          <input type='radio' name=$name value=$value "; if ($A_view['recipe'][$name] == $value) { echo "checked"; }  echo " required><br>";
}

echo "<form action='/updaterecipe/update' method='post' enctype='multipart/form-data'>
    <h1>Modification</h1>
    <input type='hidden' name='id' value='" . $A_view['recipe']['id'] . "' />

    <label><b>Nom de la recette</b></label>
    <input type='text' placeholder='nom de la recette' name='name' value='" . $A_view['recipe']['name'] . "' required>
    <br><br>

    <label><b>Photo de la recette</b></label>
    <img class='card-img' src='" . $A_view['recipe']['picture'] . "' alt='Card image cap'>
    <input type='file' id='file' name='picture' required>
    <br><br>

    <div id='container2'>";
foreach ($A_view['ingredients'] as $A_ingredient) {
    echo "<label for='ingredient'>Ingredient :</label><br>
          <input type='text' id='ingredient' name='ingredients[]' value='" . $A_ingredient['ingredient_id'] . "' required>
          <label for='ingredient'>Quantity :</label><br>
          <input type='text' id='ingredient' name='ingredients[]' value='" . $A_ingredient['quantity'] . "' required>";
}
echo "  </div>
        <button type='button' value='addFields' onclick='addIngredient()'>Ajouter un ingerdient</button><br /><br>
        
        <div id='container'>";
foreach ($A_view['utensils'] as $A_utensil) {
    echo "<label for=ustensile'>Ustensile :</label><br>
          <input type='text' id='ustensile' name='utensils[]' value='" . $A_utensil['utensil_id'] . "' required>";
}
echo "  </div>
        <button type='button' value='addFields' onclick='addUtensil()'>Ajouter un ustensile</button><br><br>

        <label><b>Temps de preparation</b></label><br>
        <input type='number' placeholder='temps de préparetion' name='cooking_time' min='0' value='" . $A_view['recipe']['cooking_time'] . "' required>
        <br><br>
        
        <label><b>Difficulte de la recette</b></label><br>";
addInputRadio($A_view, 'difficulty', 'facile');
addInputRadio($A_view, 'difficulty', 'moyen');
addInputRadio($A_view, 'difficulty', 'difficile');

echo " <br><br>
        <label><b>Cout de la recette</b></label><br>";
addInputRadio($A_view, 'cost', '€');
addInputRadio($A_view, 'cost', '€€');
addInputRadio($A_view, 'cost', '€€€');
echo "
        <br><br>
        <label><b>Description de la recette</b></label><br>
        <textarea type='text' placeholder='description de la recette' name='preparation_description' required>
           " . $A_view['recipe']['preparation_description'] . "
        </textarea>
        <br><br>

        <label><b>Type de cuisson</b></label>
        <input type='text' placeholder='type de cuisson' name='cooking_type' value='" . $A_view['recipe']['cooking_type'] . "' required>
        <br><br>

        <div id='container3'>";

foreach ($A_view['particularities'] as $A_particularity) {
    echo "<label for='particularite'>Particularite :</label><br>
        <input type='text' id='particularite' name='particularities[]' value='" . $A_particularity['particularity_id'] . "'>";
}
echo "
        </div>
        <button type='button' value='addFields' onclick='addParticularity()'>Ajouter une particularité</button><br><br>

        <input type='submit' id='submit' value='Valider' >
    </form>";
