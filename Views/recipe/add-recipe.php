
<?php
echo "<form action='/addrecipe/update' method='post' enctype='multipart/form-data' class='signup'>
    <h1>Ajouter une recette</h1>

    <label><b>Nom de la recette</b></label>
    <input type='text' placeholder='nom de la recette' name='name' required>
    <br><br>

    <label><b>Photo de la recette</b></label>
    <input type='file' id='file' name='picture' accept='.jpg, .jpeg, .png' required>
    <br><br>

    <div id='container2'>
    <label for='ingredient'>Ingredient :</label><br>
        <input type='text' id='ingredient' name='ingredients[]' value='' required>
        <label for='ingredient'>Quantité :</label><br>
        <input type='text' id='quantity' name='quantities[]' value='' required>
    </div>
    <button type='button' value='addFields' onclick='addIngredient()'>Ajouter un ingerdient</button><br /><br>
    <div id='container'>
        <label for=ustensile'>Ustensile :</label><br>
        <input type='text' id='ustensile' name='utensils[]' value='' required>
    </div>
    <button type='button' value='addFields' onclick='addUtensil()'>Ajouter un ustensile</button><br><br>

    <label><b>Temps de preparation</b></label><br>
    <input type='number' placeholder='temps de préparetion' name='cooking_time' min='0' required>
    <br><br>

    <label><b>Difficulte de la recette</b></label><br>
    <lable>Facile</lable>
    <input type='radio' name='difficulty' value='facile' required><br>
    <lable>Moyen</lable>
    <input type='radio' name='difficulty' value='moyen' required><br>
    <lable>Difficile</lable>
    <input type='radio' name='difficulty' value='difficile' required>
    <br><br>

    <label><b>Cout de la recette</b></label><br>
    <lable>€</lable>
    <input type='radio' name='cost' value='€' required><br>
    <lable>€€</lable>
    <input type='radio' name='cost' value='€€' required><br>
    <lable>€€€</lable>
    <input type='radio' name='cost' value='€€€' required>
    <br><br>

    <label><b>Description de la recette</b></label><br>
    <textarea type='text' placeholder='description de la recette' name='preparation_description' required></textarea>
    <br><br>

    <label><b>Type de cuisson</b></label>
    <input type='text' placeholder='type de cuisson' name='cooking_type' required>
    <br><br>
    <div id='container3'>
        <label for='particularite'>Particularite :</label><br>
        <input type='text' id='particularity' name='particularities[]' value='' required>
    </div>
    <button type='button' value='addFields' onclick='addParticularity()'>Ajouter une particularité</button><br><br>

    <input type='submit' id='submit' value='Ajouter la recette' >
</form>";