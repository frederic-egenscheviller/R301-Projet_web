<?php

class Ingredients{

    public static function create(array $A_postParams):array{
        $B_receive = Model::create($A_postParams, "Ingredients");
        if($B_receive){
            return array('message' => "Ingredients crée", 'status' => true);
        }
        return array('message' => "Ingredients non crée", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function delete(array $A_postParams):array{
        $B_receive = Model::deleteById($A_postParams, "Ingredients");
        if($B_receive){
            return array('message' => "Ingredients supprimé", 'status' => true);
        }
        return array('message' => "Erreur de supression", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function update(array $A_postParams):array{
        $B_receive = Model::updateById($A_postParams, "Ingredients");
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
        $A_receive = Model::selectById($I_id, "Ingredients");
        return $A_receive[0];
    }
}