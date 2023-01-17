<?php

class Utensils{
    public static function create($A_postParams){
        $B_receive = Model::create($A_postParams,"ustensil");
        if($B_receive){
            return array('message' => "Utensils crée", 'status' => true);
        }
        return array('message' => "Utensils non crée", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function delete(int $I_id):array{
        $B_receive = Model::deleteById($I_id,"ustensil");
        if($B_receive){
            return array('message' => "Utensils supprimé", 'status' => true);
        }
        return array('message' => "Erreur de supression", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function update($A_postParams):array{
        $B_receive = Model::update($A_postParams,"ustensil");
        if($B_receive){
            return array('message' => "Changements enregistrés", 'status' => true);
        }
        return array('message' => "Erreur d'enregistrement", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return mixed
     */
    public static function selectById(array $I_id):array{
        $id = $I_id['id'];
        $A_receive = Model::selectById($id,"ustensil");
        return $A_receive[0];
    }
}