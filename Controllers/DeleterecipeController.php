<?php

/**
 * DeleterecipeController
 *
 * This class is responsible for deleting a recipe.
 *
 * @final
 */
final class DeleterecipeController
{
    /**
     * deleteAction
     *
     * This method is in charge of deleting a recipe, its associated ingredients, utensils, particularities and appreciation.
     *
     * @param array $A_parametres An array of parameters
     *
     * @return void
     */
    public function deleteAction(Array $A_parametres = null) : void
    {
        if (Session::getSession()['id'] == Recipe::selectById($A_parametres[0])['user_id'] || $A_parametres == null) {
            $S_id = $A_parametres[0];
            Ingredients::deleteAllByRecipeId($S_id);
            Utensils::deleteAllByRecipeId($S_id);
            Particularities::deleteAllByRecipeId($S_id);
            Appreciation::deleteAllByRecipeId($S_id);
            Recipe::deleteRecipePicture(Recipe::selectById($S_id)['picture']);
            Recipe::deleteByID($S_id);
            header('Location: /home');
            exit;
        }
        header("Location: /recipe/show/' . $A_parametres[0] . '");
        exit;
    }
}