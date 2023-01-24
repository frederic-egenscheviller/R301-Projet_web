<?php

class Ingredients extends Model
{
    public static function selectByRecipeId($recipe_id):array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM INGREDIENTS_RECIPE WHERE recipe_id = :recipe_id";
        $sth = $O_con->prepare($S_sql);
        $sth -> bindParam(':recipe_id',$recipe_id);
        $sth->execute();
        return $sth->fetchAll();
    }
}