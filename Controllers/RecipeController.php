<?php

final class RecipeController
{
    public function defaultAction($A_postParams) {
        if($A_postParams['id'] == null) {
            View::show("errors/error404");
            exit();
        }
        View::show("recipe/recipe", Recipe::selectById($A_postParams['id']));
    }
}