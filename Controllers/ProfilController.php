<?php

final class ProfilController
{
    function showAction(Array $A_parametres = null) {
        $user_id = $A_parametres[0];
        $user = Users::selectByUserId($user_id);
        View::show("/profil/profil", Users::selectByUserId($user_id));
        View::show("/recipe/recipes", Recipe::selectRecipeByUser($user['id']));

        $session = Session::getSession();
        View::show("/appreciation/appreciation", array(
            'isOwner' => (($session != null) && ($session['user_id'] == $user_id)),
            'appreciations' => Appreciation::selectAppreciationByUser($user['id'])
        ));
    }
}