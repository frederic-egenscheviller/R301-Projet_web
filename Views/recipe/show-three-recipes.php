<?php

echo '<link rel="stylesheet" type="text/css" href="../../static/styles/show-three-recipes.css">';
echo '<div id="recipesContainer">';
foreach ($A_view as $recipe){
    echo '<div class="recipe">';
    echo $recipe['name'];
    echo "<img src='" . $recipe['picture'] . "'>";
}
echo '</div>';