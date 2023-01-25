<?php

echo '
<meta name="viewport" content="width=device-width, initial-scale=1">
<section class="top-nav">
    <div>
        JuJu KitKat
    </div>
    <input id="menu-toggle" type="checkbox" />
    <label class="menu-button-container" for="menu-toggle">
        <div class="menu-button"></div>
    </label>
    <ul class="menu">
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Recettes</a></li>
        <li><a href="#">Compte</a></li>
        <li><a href="#">A propos</a></li>
        <li><a href="#">Contact</a></li>';
if (Session::check()) {
    if(Session::getSession()['status'] == 'admin') {
        echo '
        <li><a href="/addrecipe">Ajouter une recette</a></li>
        <li><a href="/user/logout">Déconnexion</a></li>';
    } else if(Session::getSession()['status'] == 'user') {
        echo '
        <li><a href="/user/logout">Déconnexion</a></li>';
    }
} else {
    echo '
        <li><a href="/signin">Connexion</a></li>';
}
echo '
    </ul>
</section>';