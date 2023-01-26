<?php

/**
 * Class AddrecipeController
 *
 * This class contains two methods that are used to add a recipe
 *
 * @final
 */
final class AddrecipeController {

    /**
     * defaultAction
     *
     * This method check if user has logged in and then redirects to add-recipe page, else redirects to signin page
     *
     * @return void
     */
    public function defaultAction(): void
    {
        if (!Session::check()) {
            header('Location: /signin');
            exit;
        }
        View::show("/recipe/add-recipe");
    }

    /**
     * updateAction
     *
     * This method uploads a picture and creates a recipe
     *
     * @param array|null $A_parametres The array of parameters
     * @param array|null $A_postParams The array of post params
     *
     * @return void
     */
    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_postParams['picture'] = Recipe::uploadRecipePicture($A_postParams['name']);
        View::show("/recipe/add-recipe", array('message' => Recipe::createRecipe($A_postParams)));
    }
}