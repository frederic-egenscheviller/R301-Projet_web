<?php

echo "<section id='description'><h2>BIENVENUE SUR NOTRE SITE DE RECETTES DE PATISSERIE !</h2>
<p>Nous sommes heureux de vous accueillir sur notre plateforme dédiée aux amoureux de la pâtisserie.
Notre site est un lieu où les passionnés de pâtisserie peuvent partager leurs recettes, leurs astuces et leurs découvertes culinaires.
Nous avons créé cette communauté pour permettre aux gourmands de découvrir de nouvelles recettes, 
de s'inspirer et de s'échanger des idées.<br>
Pour faire une recherche par filtre, utilisez la barre ci-dessus !</p></section>";

echo '<h2 id="recipesDiscoverTitle">Faites de nouvelles découvertes culinaires !</h2>';

echo '<div id="recipesContainer">';
foreach ($A_view['randomRecipes'] as $A_recipe){
    echo '<a href="/recipe/show/'. $A_recipe['id'] . '"><section class="random-recipe-card">
                <img class="card-img" src="' . $A_recipe['picture'] . '" alt="Card image cap">
                <div class="card-info">
                    <h1 class="card-name">' . $A_recipe['name'] . '</h1>
                    <h2 class="card-difficulty">Difficulté :' . $A_recipe['difficulty'] . '</h3>
                    <h2 class="card-cooking-time">Temps de préparation :' . $A_recipe['cooking_time'] . 'minutes</p>
                    <div class="card-rating-box">
                        <h2 class="card-average-rating">Note :' . $A_recipe['average_rating'] . '/5 ★</p>
                    </div>
                </div>
            </section></a>';
}
echo '</div>';