<?php

echo "<section class='appreciations'>
        <h1 class='appreciation-title'>Vos commentaires</h1><br/>
        <ul class='appreciations-content'>";

if($A_view['isOwner']) {
    foreach ($A_view['appreciations'] as $A_appreciation) {
        echo "<li class='appreciation'>
                <a class='appreciation-link' href='/recipe/show/" . $A_appreciation['recipe_id'] . "'>" . $A_appreciation['rating'] . ' ★ - ' . $A_appreciation['comment'] . "</a>
                <a id='submit' href='/recipe/editappreciation/" . $A_appreciation['recipe_id'] . "/" . $A_appreciation['id'] . "'>Modifier l'appréciation</a>
            </li>";
    }
} else {
    foreach ($A_view['appreciations'] as $A_appreciation) {
        echo "<li class='appreciation'><a class='appreciation-link' href='/recipe/show/" . $A_appreciation['recipe_id'] . "'>" . $A_appreciation['rating'] . ' ★ - ' . $A_appreciation['comment'] . "</a></li>";
    }
}

echo   "</ul>
      </section>";

