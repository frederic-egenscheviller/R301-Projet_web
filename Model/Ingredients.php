<?php

class Ingredients extends Model{

    public static function selectAllByRecipeId(int $I_recipe_id):array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT ingredient_id, quantity FROM INGREDIENTS_RECIPE WHERE recipe_id = :recipe_id";
        $sth = $O_con->prepare($S_sql);
        $sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }
}