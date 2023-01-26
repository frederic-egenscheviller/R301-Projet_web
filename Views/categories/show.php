<?php
function dropdown($A_list, $name, $dropDownID, $dropNameID, $frenchName) {
    echo'
    <div class="dropdown">
    <a class="dropbtn" id='.$dropDownID.'>'.$frenchName.'</a>
    <div class="dropdown-content" id='. $dropNameID .'>';
    foreach ($A_list as $item) {
        echo '<div class="checkboxContainer">';
        echo '<input type="checkbox" name="'.$name.'[]" value="' . $item[0] . '">';
        echo '<p class="checkboxLabel">' . $item[0] . '</p>';
        echo '</div>';
    }
    echo '</div>
      </div>';
}
echo '
<form action="/searchRecipes" method="post">
<div id="features">';
dropdown($A_view['ingredients'], 'ingredients', 'ingredientsBtn', 'dropIngredients', 'Ingrédients');
dropdown($A_view['utensils'], 'utensils', 'utensilsBtn', 'dropUtensils', 'Ustensiles');
dropdown($A_view['cooking_types'], 'cooking_types', 'cookingTypesBtn', 'dropTypes', 'Types de cuisson');
dropdown($A_view['particularities'], 'particularities', 'particularitiesBtn', 'dropParticularities', 'Particularités');
dropdown($A_view['costs'], 'costs', 'costsBtn', 'dropCosts', 'Coûts');
dropdown($A_view['difficulties'], 'difficulties', 'difficultiesBtn', 'dropDifficulties', 'Difficultés');
echo '
  <input id="sendFeaturesSearch" type="submit">
</div>
</form>';
echo '<script type="text/javascript" src="/static/js/filterBtnShow.js"></script>';
