<?php

echo '
<section id="recipe-container">
        <section id="recipe-card">
            <img class="card-img" src="' . $A_view['recipe']['picture'] . '" alt="Card image cap">
            <div class="card-info">
                <h1 class="card-name">' . $A_view['recipe']['name'] . '</h1>
                <h2 class="card-difficulty">Difficulté :' . $A_view['recipe']['difficulty'] . '</h3>
                <h2 class="card-cooking-time">Temps de préparation :' . $A_view['recipe']['cooking_time'] . 'minutes</p>
                <h2 class="card-rating-box">Note :' . $A_view['recipe']['average_rating'] . '/5 ★</p>
            </div>
        </section>
    <section id="recipe-necessary-elements">
        <section id="recipe-ingredients">
            <h2>Ingrédients</h2>
            <section class="ingredient">
                <ul>';
                foreach($A_view['ingredients'] as $ingredient) {
                    echo '
                        <li>' . $ingredient['ingredient_id'] . '</li>';
                }
echo '
                </ul>
            </section>
        </section>
        <section id="recipe-utensils">
            <h2>Ustensiles</h2>
            <section class="utensil">
                <ul>';
                foreach($A_view['utensils'] as $utensil) {
                    echo '
                        <li>' . $utensil['utensil_id'] . '</li>';
                }
echo '   
                </ul>
            </section>
    </section>
</section>';