<?php

echo "
<meta name='viewport' content='width=device-width, initial-scale=1'>
<section class='top-nav'>
    <div>
        JuJu KitKat
    </div>
    <input id='menu-toggle' type='checkbox' />
    <label class='menu-button-container'' for='menu-toggle'>
        <div class='menu-button'></div>
    </label>
    <ul class='menu'>
        <li><a href='/home'>Accueil</a></li>
        <li><a href='/allrecipes'>Recettes</a></li>
        <li><a href='/profil'>Compte</a></li>
        <li><a href='/contact/form'>Contact</a></li>";
if (Session::check()) {
    if(Session::getSession()['status'] == 'admin') {
        echo '<li><a href="/addrecipe">Ajouter une recette</a></li>';
    }
    echo '<li><a href="/logout">Déconnexion</a></li>';
} else {
    echo '
        <li><a href="/signin">Connexion</a></li>';
}
echo '
    </ul>
</section>';