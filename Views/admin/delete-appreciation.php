<?php
echo "<section class='appreciations'>
        <h1 class='appreciation-title'>Cliquez pour supprimer l'appreciation</h1><br/>
        <ul class='appreciations-content'>";
foreach ($A_view as $A_appreciation) {
    echo "<li class='appreciation'><a class='appreciation-link' href='/admin/deleteappreciation/" . $A_appreciation['id'] . "'>" . $A_appreciation['comment'] . "</a></li>";
}
echo   "</ul>
      </section>";