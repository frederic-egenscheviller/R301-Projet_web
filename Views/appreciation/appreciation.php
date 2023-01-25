<?php

echo "<label>Vos commentaires</label>";
foreach ($A_view as $A_appreciation) {
    echo "<a href='/recipe/show/" . $A_appreciation['recipe_id'] . "'>" . $A_appreciation['comment'] . "</a><br />";
}
