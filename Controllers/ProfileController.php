<?php

/**
 * Class ProfileController
 *
 * Final class for the ProfileController.
 *
 * @final
 */
final class ProfileController
{
    /**
     * showAction
     *
     * Show the profile page
     *
     * @param Array $A_parametres - The array of parametres.
     *
     * @return void
     */
    function showAction(Array $A_parametres = null) : void{
        $S_user_id = $A_parametres[0];
        $A_user = Users::selectByUserId($S_user_id);
        View::show("/profile/profile", Users::selectByUserId($S_user_id));
        View::show("/recipe/recipes", Recipe::selectRecipeByUser($A_user['id']));

        $A_session = Session::getSession();
        View::show("/appreciation/appreciation", array(
            'isOwner' => (($A_session != null) && ($A_session['user_id'] == $S_user_id)),
            'appreciations' => Appreciation::selectAppreciationByUser($A_user['id'])
        ));
    }
}