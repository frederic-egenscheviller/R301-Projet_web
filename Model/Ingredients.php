<?php

class Ingredients extends Model{

    public static function selectAllByRecipeId(int $I_recipe_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT ingredient_id, quantity FROM INGREDIENTS_RECIPE WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }
}