<?php

final class SearchRecipesController
{
    public function defaultAction($A_postParams) {
        View::show("recipe/recipes", Recipe::selectBySearch($A_postParams));
    }
}