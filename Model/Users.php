<?php
class Users {

    /**
     * @param $A_postParams
     * @return array
     */
    public static function create(array $A_postParams):array{
        $A_picture = Upload::upploadPicture($A_postParams);
        $A_postParams['picture'] = $A_picture;
        $B_receive = Model::create($A_postParams, "user");
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
        $B_receive = Model::deleteById($I_id, "user");
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
        $A_picture = Upload::upploadPicture($A_postParams);
        $A_postParams['picture'] = $A_picture;
        $B_receive = Model::update($A_postParams, "user");
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
        $A_receive = Model::selectById($I_id, "user");
        return $A_receive[0];
    }
}