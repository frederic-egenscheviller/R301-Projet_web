<?php

class Appreciation extends Model
{
    public static function selectAppreciationByUser(string $S_id) : array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM Appreciation WHERE user_id = :user";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':user', $S_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }

    public static function selectAllByRecipeId(string $S_recipe_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM APPRECIATION WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$S_recipe_id);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }
}