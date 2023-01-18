<?php

class Appreciation
{
    /**
     * @param $A_postParams
     * @return array
     */
    public static function create(array $A_postParams):array{
        $B_receive = Model::create($A_postParams, "appreciation");
        if($B_receive){
            return array('message' => "Utilisateur crée", 'status' => true);
        }
        return array('message' => "Utilisateur non crée", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function delete(int $I_id):array{
        $B_receive = Model::deleteById($I_id, "appreciation");
        if($B_receive){
            return array('message' => "Utilisateur supprimé", 'status' => true);
        }
        return array('message' => "Erreur de supression", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function update(array $A_postParams):array{
        $B_receive = Model::update($A_postParams, "appreciation");
        if($B_receive){
            return array('message' => "Changements enregistrés", 'status' => true);
        }
        return array('message' => "Erreur d'enregistrement", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return mixed
     */
    public static function selectById(int $I_id):array{
        $A_receive = Model::selectById($I_id, "appreciation");
        return $A_receive[0];
    }

    public static function selectAppreciationByUser($A_postParams){
        $I_id = $A_postParams['id'];
        $O_con = Model::initConnection();
        $S_sql = "SELECT * FROM Appreciation WHERE user_id = :user";

        $sth = $O_con->prepare($S_sql);
        $sth->bindValue(':user', $I_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }
}