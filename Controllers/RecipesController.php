<?php
final class RecipesController
{
    public function defaultAction() {
        View::show("recipe/show", Recipe::selectAll());
    }
}