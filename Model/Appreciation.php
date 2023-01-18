<?php

class Appreciation extends Model
{
    public static function selectAppreciationByUser($A_postParams){
        $I_id = $A_postParams['id'];
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM Appreciation WHERE user_id = :user";

        $sth = $O_con->prepare($S_sql);
        $sth->bindValue(':user', $I_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }
}