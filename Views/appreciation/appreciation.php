<?php

echo "<section class='appreciations'>
        <h1 class='appreciation-title'>Vos commentaires</h1><br/>
        <ul class='appreciations-content'>";
foreach ($A_view as $A_appreciation) {
    echo "<li class='appreciation'><a class='appreciation-link' href='/recipe/show/" . $A_appreciation['recipe_id'] . "'>" . $A_appreciation['rating'] . ' ★ - ' . $A_appreciation['comment'] . "</a></li>";
}
echo   "</ul>
      </section>";

