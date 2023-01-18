<?php

class Particularities{
    public static function create(array $A_postParams):array{
        $B_receive = Model::create($A_postParams, "peculiarities");
        if($B_receive){
            return array('message' => "Particularité crée", 'status' => true);
        }
        return array('message' => "Particularité non crée", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function delete(int $I_id):array{
        $B_receive = Model::deleteById($I_id, "peculiarities");
        if($B_receive){
            return array('message' => "Particularité supprimé", 'status' => true);
        }
        return array('message' => "Erreur de supression", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function update(array $A_postParams):array{
        $B_receive = Model::update($A_postParams, "peculiarities");
        if($B_receive){
            return array('message' => "Changements enregistrés", 'status' => true);
        }
        return array('message' => "Erreur d'enregistrement", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return mixed
     */
    public static function selectById(int $I_ID):array{
        $id = $I_ID['id'];
        $A_receive = Model::selectById($id, "peculiarities");
        return $A_receive[0];
    }
}