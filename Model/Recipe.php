<?php

class Recipe{

    public static function create(array $A_postParams):array{
        $A_picture = Upload::uploadPicture($A_postParams);
        $A_postParams['picture'] = $A_picture;
        $B_receive = Model::create($A_postParams, "recipe");
        if($B_receive){
            return array('message' => "Recette crée", 'status' => true);
        }
        return array('message' => "Recette non crée", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function delete(int $I_id):array{
        $B_receive = Model::deleteById($I_id, "recipe");
        if($B_receive){
            return array('message' => "Recette supprimé", 'status' => true);
        }
        return array('message' => "Erreur de supression", 'status' => false);
    }

    /**
     * @param $A_postParams
     * @return array
     */
    public static function update(array $A_postParams):array{
        $A_picture = Upload::uploadPicture($A_postParams);
        $A_data['picture'] = $A_picture;
        $B_receive = Model::updateById($A_postParams, "recipe");
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
        $A_receive = Model::selectById($I_id, "recipe");
        return $A_receive[0];
    }

    /**
     * @return array
     */
    public static function randomRecipe():array{
        $I_IdMax = Model::selectHowMany();
        $A_id = array(rand(0,$I_IdMax),rand(0,$I_IdMax),rand(0,$I_IdMax));
        $A_data = array();
        foreach ($A_id as $I_id){
            array_push($A_data, self::selectById($I_id, "recipe"));
        }
        return $A_data;
    }

    public static function selectRecipeByUser(array $A_postParams):array{
        $I_id = $A_postParams['id'];
        $O_con = Model::initConnection();
        $S_sql = "SELECT * FROM RECIEPE WHERE user_id = :user";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        $sth->bindValue(':user', $I_id, PDO::PARAM_INT);
        return $sth->fetchAll();
    }
}