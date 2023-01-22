<?php
final class AllRecipesController
{
    public function defaultAction() {
        View::show("recipe/recipes", Recipe::selectAll());
    }
}