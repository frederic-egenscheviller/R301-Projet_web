<?php


echo '
<section id="recipe-comments">
    <h2>Commentaires</h2>
    <section id="comments">';
foreach ($A_view['appreciation'] as $appreciation) {
    echo '<section class="comment">
        <h3 class="comment-text">Posté par : <a href="/profil/show/' . $appreciation['user_id'] . ' ">' . $appreciation['id'] . '</a>, le '. date("d/m/Y", strtotime($appreciation['appreciation_date'])) .'</h3>
        <p>' . $appreciation['rating'] . ' ★ - ' . $appreciation['comment'] . '</p>
    </section>';
}
echo '
    </section>
</section>';