<?php

final class RecipeController
{
    public function defaultAction() {
        if($_GET['id'] == null) {
            View::show("errors/error404");
            exit();
        }
        View::show("recipe/recipe", Recipe::selectById($_GET['id']));
    }
}