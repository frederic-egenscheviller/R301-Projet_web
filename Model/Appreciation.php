<?php

class Appreciation extends Model
{
    public static function selectAppreciationByUser(string $id){
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM Appreciation WHERE user_id = :user";

        $sth = $O_con->prepare($S_sql);
        $sth->bindValue(':user', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function selectByRecipeId($recipe_id):array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM APPRECIATION WHERE recipe_id = :recipe_id";
        $sth = $O_con->prepare($S_sql);
        $sth -> bindParam(':recipe_id',$recipe_id);
        $sth->execute();
        return $sth->fetchAll();
    }
}