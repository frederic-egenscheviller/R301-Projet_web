<?php
echo "<form action='../helloworld/testform.php' method='POST'>
        <h1>Ajouter une recette</h1>
    
        <label><b>Nom de la recette</b></label>
        <input type='text' placeholder='nom de la recette' name='recipename' required>
        <br><br>
    
        <label><b>Photo de la recette</b></label>
        <input type='file' name='recipepicture' id='rp' required/>
        <br><br>
    
        <div id='container2'>
        <label for='ingredient'>Ingredient :</label><br>
            <input type='text' id='ingredient' name='ingredient[]' value='' required>
        </div>
        <button type='button' value='addFields' onclick='addIngredient()'>Ajouter un ingerdient</button><br /><br>
        <div id='container'>
            <label for=ustensile'>Ustensile :</label><br>
            <input type='text' id='ustensile' name='ustensile[]' value='' required>
        </div>
        <button type='button' value='addFields' onclick='addUtensil()'>Ajouter un ustensile</button><br><br>

        <label><b>Temps de preparation</b></label>
        <input type='text' placeholder='temps de préparetion' name='preparationtime' required>
        <br><br>

        <label><b>Difficulte de la recette</b></label>
        <input type='int' placeholder='difficulte de la recette' name='difficulté' required>
        <br><br>

        <label><b>Cout de la recette</b></label>
        <input type='int' placeholder='cout de la recette' name='recipecost' required>
        <br><br>

        <label><b>Description de la recette</b></label>
        <input type='text' placeholder='description de la recette' name='description' required>
        <br><br>

        <label><b>Type de cuisson</b></label>
        <input type='text' placeholder='type de cuisson' name='cookingtype' required>
        <br><br>

        <div id='container3'>
            <label for='particularite'>Particularite :</label><br>
            <input type='text' id='particularite' name='particularite[]' value='' required>
        </div>
        <button type='button' value='addFields' onclick='addParticularity()'>Ajouter une particularité</button><br><br>

        <input type='submit' id='submit' value='Ajouter la recette' >
    </form>";