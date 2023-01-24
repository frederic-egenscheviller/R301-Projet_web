<?php

class Recipe extends Model
{

    public static function addRecipeElem(int $I_recipeId ,array $A_params, string $S_table):bool{
        $O_con = Connection::initConnection();
        foreach($A_params as $S_elem){
            try{
                switch ($S_table){
                    case 'ingerdients' :
                        Ingredients::create($S_elem);
                        break;
                    case 'utensils' :
                        Utensils::create($S_elem);
                        break;
                    case 'particularities' :
                        Particularities::create($S_elem);
                        break;
                } 
            }catch(Exception $e){}

            $S_sql = "insert into :table values (:recipe, :elem)";
            $sth = $O_con->prepare($S_sql);
            $sth->bindValue(':table', $S_table."_recipe", PDO::PARAM_STR);
            $sth->bindValue(':elem', $S_elem, PDO::PARAM_STR);
            $sth->bindValue(':recipe', $I_recipeId, PDO::PARAM_STR);
            return $sth->execute();
        }
    }

    public static function create(array $A_postParams):bool{

        if(self::create($A_postParams)){
        
            $O_con = Connection::initConnection();
            $S_sql = "select id from recipe where name = :name and preparation_description = :desc";
            $sth = $O_con->prepare($S_sql);
            $sth->bindValue(':name', $A_postParams['name'], PDO::PARAM_STR);
            $sth->bindValue(':desc', $A_postParams['preparation_description'], PDO::PARAM_STR);
            $sth->execute();
            $A_recipe = $sth->fetch();
            $I_recipeId = intval($A_recipe['id']);

            $B_flag = true;
            if(isset($A_postParams['ingredients']) && $B_flag){
                $B_flag = self::addRecipeElem($I_recipeId ,$A_postParams['ingredients'], "ingredients");
            }
            if(isset($A_postParams['utensils']) && $B_flag){
                $B_flag = self::addRecipeElem($I_recipeId ,$A_postParams['utensils'], "utensils");
            }
            if(isset($A_postParams['particularities']) && $B_flag){
                $B_flag = self::addRecipeElem($I_recipeId ,$A_postParams['particularities'], "particularities");
            }
            return $B_flag;
        }
    }

    public static function randomRecipe():array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT * FROM RECIPE ORDER BY RANDOM() LIMIT 3";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }


    static function selectRecipeByUser(array $A_postParams):array{
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

    public static function selectDifficulties(): array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT DISTINCT DIFFICULTY FROM RECIPE";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function selectCosts(): array{
        $O_con = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COST FROM RECIPE";
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function uploadRecipePicture(array $A_getParams):string{
        return UploadPicture::uploadPicture($A_getParams);
    }


    public static function searchRecipe(array $A_getParams):array{
        $S_sql = "SELECT distinct r.* 
        FROM Recipe r, Ingredients_recipe i, Utensils_recipe u, Particularities_recipe p
        WHERE r.name LIKE :search ";

        $S_search = isset($A_getParams['search']) ? "%".$A_getParams['search']."%" : "'%%'";

        $A_params = array(':search'=>array($S_search,PDO::PARAM_STR));

        function addToQuery($table,$A_getParams){
            $S_underSql = "select id from $table
            where ";
            foreach($A_getParams as $value){
                $S_underSql .= " id = :param$value or";
                $A_params[':param'.$value]=array($value, PDO::PARAM_STR);
            }
            $S_underSql = substr( $S_underSql,0,-3);
            return array($S_underSql, $A_params);
        }

        if(isset($A_getParams['ingredients'])){
            $A_result = addToQuery("ingredients",$A_getParams['ingredients']);
            $A_params += $A_result[1];
            $S_sql.="AND r.id = i.recipe_id
            AND i.ingredient_id IN (". $A_result[0].") ";
        }

        if(isset($A_getParams['utensil'])){
            $A_result = addToQuery("utensils",$A_getParams['utensils']);
            $A_params += $A_result[1];
            $S_sql.="AND r.id = u.recipe_id
            AND u.utensil_id IN (". $A_result[0].") ";
        }

        if(isset($A_getParams['particularity'])){
            $A_result = addToQuery("particularities",$A_getParams['particularities']);
            $A_params += $A_result[1];
            $S_sql.="AND r.id = u.recipe_id
            AND u.utensil_id IN (". $A_result[0].") ";
        }

        if(isset($A_getParams['cooking_times']) && intval($A_getParams['cooking_times'])>1){
            $I_cookingTime = intval($A_getParams['cooking_times']);
            $S_sql.="AND r.cooking_time <= :cookingTime ";
            $A_params[':cookingTime']=array($I_cookingTime,PDO::PARAM_INT);
        }

        if(isset($A_getParams['difficulties'])){
            $S_sql.="AND (";
            foreach($A_getParams['difficulties'] as $value){
                $S_sql .= "r.difficulty = :param$value or ";
                $A_params[':param'.$value]=array($value, PDO::PARAM_STR);
            }
            $S_sql = substr( $S_sql,0,-3);
            $S_sql.=") ";
        }

        if(isset($A_getParams['costs'])){
            $S_sql.="AND (";
            foreach($A_getParams['costs'] as $value){
                $S_sql .= "r.cost = :param$value or ";
                $A_params[':param'.$value]=array($value, PDO::PARAM_STR);
            }
            $S_sql = substr( $S_sql,0,-3);
            $S_sql.=") ";
        }
        $O_con = Connection::initConnection();
        $sth = $O_con->prepare($S_sql);

        foreach($A_params as $key => $value){
            $sth->bindValue($key,  $value[0], $value[1]);
        }

        $sth->execute();
        return($sth->fetchAll());
    }

}