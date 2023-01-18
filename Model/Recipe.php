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
        return Model::selectById($I_id, "RECIPE");
    }

    /**
     * @return array
     */
    public static function randomRecipe():array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM RECIPE ORDER BY RANDOM() LIMIT 3";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function selectRecipeByUser(array $A_postParams):array{
        $I_id = $A_postParams['id'];
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM RECIPE WHERE user_id = :user";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        $sth->bindValue(':user', $I_id, PDO::PARAM_INT);
        return $sth->fetchAll();
    }

    public static function selectCookingTimes(): array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COOKING_TIME FROM RECIPE";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function selectCookingTypes(): array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COOKING_TYPE FROM RECIPE";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function selectDifficulty(): array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT DISTINCT DIFFICULTY FROM RECIPE";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function selectCost(): array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COST FROM RECIPE";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }




}