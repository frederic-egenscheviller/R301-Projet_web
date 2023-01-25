<?php

echo '
<form action="/searchrecipes/searchRecipe" method="post">
<div id="features">
  <div class="search_box">
    <input name"search" type"text" placeholder="Search">
  </div>
  <div class="dropdown">
    <a class="dropbtn" id="ingredientsBtn">Ingrédients</a>
    <div class="dropdown-content" id="dropIngredients">';
foreach ($A_view['ingredients'] as $ingredient) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="ingredients[]" value="' . $ingredient[0] . '">';
    echo '<p class="checkboxLabel">' . $ingredient[0] . '</p>';
    echo '</div>';
}
echo '</div>
    </div>
  <div class="dropdown">
    <a class="dropbtn" id="utensilsBtn">Ustensiles</a>
    <div class="dropdown-content" id="dropUtensils">';
foreach ($A_view['utensils'] as $utensil) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="utensils[]" value="' . $utensil[0] . '">';
    echo '<p class="checkboxLabel">' . $utensil[0] . '</p>';
    echo '</div>';
}
echo '</div>
  </div>
  <div class="dropdown">
    <a class="dropbtn" id="cookingTimesBtn">Temps de préparation</a>
    <div class="dropdown-content" id="dropTimes">';
foreach ($A_view['cooking_times'] as $cooking_time) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="cooking_times[]" value="' . $cooking_time[0] . '">';
    echo '<p class="checkboxLabel">' . $cooking_time[0] . '</p>';
    echo '</div>';
}
echo '</div>
  </div>
  <div class="dropdown">
    <a class="dropbtn" id="cookingTypesBtn">Types de cuisson</a>
    <div class="dropdown-content" id="dropTypes">';
foreach ($A_view['types_cooking'] as $cooking_type) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="cooking_types[]" value="' . $cooking_type[0] . '">';
    echo '<p class="checkboxLabel">' . $cooking_type[0] . '</p>';
    echo '</div>';
}
echo '</div>
  </div>
  <div class="dropdown">
    <a class="dropbtn" id="difficultiesBtn">Difficultés</a>
    <div class="dropdown-content" id="dropDifficulties">';
foreach ($A_view['difficulties'] as $difficulty) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="difficulties[]" value="' . $difficulty[0] . '">';
    echo '<p class="checkboxLabel">' . $difficulty[0] . '</p>';
    echo '</div>';
}
echo '</div>
  </div> 
  <div class="dropdown">
    <a class="dropbtn" id="costsBtn">Coût</a>
    <div class="dropdown-content" id="dropCosts">';
foreach ($A_view['costs'] as $cost) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="costs[]" value="' . $cost[0] . '">';
    echo '<p class="checkboxLabel">' . $cost[0] . '</p>';
    echo '</div>';
}
echo '</div>
  </div>
  <div class="dropdown">
    <a class="dropbtn" id="particularitiesBtn">Particularités</a>
    <div class="dropdown-content" id="dropParticularities">';
foreach ($A_view['particularities'] as $particularity) {
    echo '<div class="checkboxContainer">';
    echo '<input type="checkbox" name="particularities[]" value="' . $particularity[0] . '">';
    echo '<p class="checkboxLabel">' . $particularity[0] . '</p>';
    echo '</div>';
}
echo '</div>
  </div>
  <input id="sendFeaturesSearch" type="submit">
</div>
</form>';

echo '<script type="text/javascript" src="/static/js/filterBtnShow.js"></script>';

?>