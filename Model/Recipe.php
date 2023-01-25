<?php

class Recipe extends Model
{

    public static function addRecipeElem(int $I_recipeId ,array $A_params, string $S_table):bool{
        
        $O_con = Connection::initConnection();
        foreach($A_params as $S_elem){
            $S_sql = "";

            if($S_table=='utensils'){
                $S_sql = "insert into utensils_recipe values (:recipe, :elem)";
                try{
                    Utensils::create(array('id' => $S_elem));
                }catch(Exception $e){}
            }
            elseif($S_table=='particularities'){
                $S_sql = "insert into particularities_recipe values (:recipe, :elem)";
                try{
                    Particularities::create(array('id' => $S_elem));
                }catch(Exception $e){}
            }
            else{
                return false;
            }
            
            $sth = $O_con->prepare($S_sql);
            $sth->bindValue(':elem', $S_elem, PDO::PARAM_STR);
            $sth->bindValue(':recipe', $I_recipeId, PDO::PARAM_STR);
            $sth->execute(); 
        }
        return true;
    }

    public static function addRecipeIngredient(int $I_recipeId ,array $A_listIngredients, array $A_listQuantities):bool{
        
        $O_con = Connection::initConnection();
        $I_sizeOfArray = sizeof($A_listIngredients);
        for($I_i = 0; $I_i < $I_sizeOfArray; $I_i++){
            try{
                Ingredients::create(array('id' => $A_listIngredients[$I_i]));
            }catch(Exception $e){}
            
            $S_sql = "insert into ingredients_recipe values (:recipe, :elem, :quantity)";
            $sth = $O_con->prepare($S_sql);
            $sth->bindValue(':quantity', $A_listQuantities[$I_i], PDO::PARAM_STR);
            $sth->bindValue(':elem', $A_listIngredients[$I_i], PDO::PARAM_STR);
            $sth->bindValue(':recipe', $I_recipeId, PDO::PARAM_STR);
            $sth->execute();
        }
         return true;
    }

    public static function createRecipe(array $A_postParams):string{
        $O_con = Connection::initConnection();
        $S_sql = "INSERT INTO RECIPE (name, picture, preparation_description, cooking_time, difficulty, cost, cooking_type, user_id)
        VALUES (:name, :picture, :preparation_description, :cooking_time, :difficulty, :cost, :cooking_type, :user_id)";
        $sth = $O_con->prepare($S_sql);
        $sth->bindValue(':name', $A_postParams['name'], PDO::PARAM_STR);
        $sth->bindValue(':picture', $A_postParams['picture'], PDO::PARAM_STR);
        $sth->bindValue(':preparation_description', $A_postParams['preparation_description'], PDO::PARAM_STR);
        $sth->bindValue(':cooking_time', $A_postParams['cooking_time'], PDO::PARAM_INT);
        $sth->bindValue(':difficulty', $A_postParams['difficulty'], PDO::PARAM_STR);
        $sth->bindValue(':cost', $A_postParams['cost'], PDO::PARAM_STR);
        $sth->bindValue(':cooking_type', $A_postParams['cooking_type'], PDO::PARAM_STR);
        $sth->bindValue(':user_id', Session::getSession()['id'], PDO::PARAM_STR);
        $B_flag = $sth->execute();

        if($B_flag){

            $S_sql = "select id from recipe where name = :name and preparation_description = :desc";
            $sth = $O_con->prepare($S_sql);
            $sth->bindValue(':name', $A_postParams['name'], PDO::PARAM_STR);
            $sth->bindValue(':desc', $A_postParams['preparation_description'], PDO::PARAM_STR);
            $B_flag = $sth->execute();
            $A_recipe = $sth->fetch();
            $O_con=null;
            $I_recipeId = intval($A_recipe['id']);

            if(isset($A_postParams['ingredients']) && $B_flag){
                $B_flag = self::addRecipeIngredient($I_recipeId ,$A_postParams['ingredients'], $A_postParams['quantities']);
            }
            if(isset($A_postParams['utensils']) && $B_flag){
                $B_flag = self::addRecipeElem($I_recipeId ,$A_postParams['utensils'], "utensils");
            }
            if(isset($A_postParams['particularities']) && $B_flag){
                $B_flag = self::addRecipeElem($I_recipeId ,$A_postParams['particularities'], "particularities");
            }
        }
        $S_result = $B_flag ? "Vous avez bien ajouté la recette" : "Vous erreur dans l'ajout de la recette";
        return $S_result;
    }
    
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
        $sth->bindValue(':user', $I_id, PDO::PARAM_INT);
        $sth->execute();
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

    public static function uploadRecipePicture(string $name):string{
        return UploadPicture::uploadPicture($name . Recipe::selectHowMany(), true);
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