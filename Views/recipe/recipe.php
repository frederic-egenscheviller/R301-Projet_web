<?php

echo '
<section id="recipe-container">
        <section id="recipe-card">
            <img class="card-img" src="' . $A_view['picture'] . '" alt="Card image cap">
            <div class="card-info">
                <h1 class="card-name">' . $A_view['name'] . '</h1>
                <h2 class="card-difficulty">Difficulté :' . $A_view['difficulty'] . '</h3>
                <h2 class="card-cooking-time">Temps de préparation :' . $A_view['cooking_time'] . 'minutes</p>
                <h2 class="card-rating-box">Note :' . $A_view['average_rating'] . '/5 ★</p>
            </div>
        </section>
';