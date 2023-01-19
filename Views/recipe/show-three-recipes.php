<?php

echo "<section id='description'><h2>BIENVENUE SUR NOTRE SITE DE RECETTES DE PATISSERIE !</h2>
<p>Nous sommes heureux de vous accueillir sur notre plateforme dédiée aux amoureux de la pâtisserie.
Notre site est un lieu où les passionnés de pâtisserie peuvent partager leurs recettes, leurs astuces et leurs découvertes culinaires.
Nous avons créé cette communauté pour permettre aux gourmands de découvrir de nouvelles recettes, 
de s'inspirer et de s'échanger des idées.<br>
Pour faire une recherche par filtre, utilisez la barre ci-dessus !</p></section>";
echo '<link rel="stylesheet" type="text/css" href="../../static/styles/show-three-recipes.css">';

echo '<h2 id="recipesDiscoverTitle">Faites de nouvelles découvertes culinaires !</h2>';
echo '<div id="recipesContainer">';
foreach ($A_view['randomRecipes'] as $recipe){
    echo '<div class="recipe">';
    echo "<img src='" . $recipe['picture'] . "'>";
    echo "<p>".$recipe['name']."</p>";
    echo '</div>';
}
echo '</div>';