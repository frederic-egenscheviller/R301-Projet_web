<?php

echo '<section class="recipes-container">';
foreach($A_view as $A_recipe) {
    echo '
    <a href="/recipe/show/'. $A_recipe['id'].'">
            <section class="card">
                <img class="card-img" src="' . $A_recipe['picture'] . '" alt="Card image cap">
                <div class="card-info">
                    <h1 class="card-name">' . $A_recipe['name'] . '</h1>
                    <h2 class="card-difficulty">Difficulty :' . $A_recipe['difficulty'] . '</h3>
                    <h2 class="card-cooking-time">Cooking time :' . $A_recipe['cooking_time'] . 'minutes</p>
                    <div class="card-rating-box">
                        <h2 class="card-average-rating">Rating :' . $A_recipe['average_rating'] . '/5 ★</p>
                    </div>
                </div>
            </section></a>';
}
echo '</section>';