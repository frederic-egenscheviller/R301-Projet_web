<?php

echo '
    <section id="add-appreciation">
    <h2>Modifier un commentaire</h2>
    <form action="/recipe/updateappreciation" method="post">
        <input type="hidden" name="recipe_id" value="' . $A_view['recipe']['id'] . '">
        <input type="hidden" name="appreciation_date" value="'. date("Y-m-d") .'">
        <input type="hidden" name="id" value="' . $A_view['appreciation']['id'] . '">
        <section id="rating">
            <label for="rating"><h3>Note</h3></label>
            <input type="number" name="rating" min="0" max="5" step="1" value="' . $A_view['appreciation']['rating'] . '">
        </section>
        <textarea name="comment" id="comment" placeholder="Commentaire">' . $A_view['appreciation']['comment'] . '</textarea>
        <input type="submit" value="Modifier">
    </form>
</section>';