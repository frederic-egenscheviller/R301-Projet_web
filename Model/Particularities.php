<?php

class Particularities extends Model{

    public static function selectAllByRecipeId(int $I_recipe_id):array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT particularity_id FROM particularities_RECIPE WHERE recipe_id = :recipe_id";
        $sth = $O_con->prepare($S_sql);
        $sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }

}