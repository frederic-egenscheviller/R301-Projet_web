<?php

echo '
    <section id="add-appreciation">
    <h2>Ajouter un commentaire</h2>
    <form action="/recipe/uploadappreciation" method="post">
        <input type="hidden" name="recipe_id" value="' . $A_view['recipe']['id'] . '">
        <input type="hidden" name="appreciation_date" value="'. date("Y-m-d") .'">
        <input type="hidden" name="user_id" value="'. Session::getSession()['id'] .'">
        <section id="rating">
            <label for="rating"><h3>Note</h3></label>
            <input type="number" name="rating" min="0" max="5" step="1" value="0">
        </section>
        <textarea name="comment" id="comment" placeholder="Commentaire"></textarea>
        <input type="submit" value="Ajouter">
    </form>
</section>';