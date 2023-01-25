<?php

final class ProfilController
{
    function showAction(Array $A_parametres = null) {
        $user_id = $A_parametres[0];
        $user = Users::selectByUserId($user_id);
        View::show("/profil/profil", Users::selectByUserId($user_id));
        View::show("/recipe/recipes", Recipe::selectRecipeByUser($user['id']));
        View::show("/appreciation/appreciation", Appreciation::selectAppreciationByUser($user['id']));
    }
}