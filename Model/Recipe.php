<?php
class Recipe extends Model{

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



    public static function addToQuery($S_table, $S_itemId, $A_items){
        $S_s = "and id in (SELECT RECIPE_ID FROM $S_table WHERE ";
        foreach ($A_items as $item){
            $S_s = $S_s."$S_itemId = '$item' and ";
        }
        $S_s = substr($S_s, 0, -4) . ") ";
        return $S_s;
    }


    public static function searchRecipe(array $A_getParams): array{

        $S_sql = "SELECT distinct r.* FROM Recipe r WHERE r.name LIKE :search ";
        $S_search = isset($A_getParams['search']) ? "%" . $A_getParams['search'] . "%" : "%";

        if (isset($A_getParams['ingredients'])) {
            $S_sql = $S_sql . self::addToQuery('INGREDIENTS_RECIPE', 'INGREDIENT_ID', $A_getParams['ingredients']);
        }

        if (isset($A_getParams['particularities'])) {
            $S_sql = $S_sql . self::addToQuery('PARTICULARITIES_RECIPE', 'PARTICULARITY_ID', $A_getParams['particularities']);
        }

        if (isset($A_getParams['utensils'])) {
            $S_sql = $S_sql . self::addToQuery('UTENSILS_RECIPE', 'UTENSIL_ID', $A_getParams['utensils']);
        }

        if(isset($A_getParams['cooking_type'])){
            foreach ($A_getParams['cooking_type'] as $S_type) {
                $S_sql = $S_sql . " and cooking_type = '$S_type' ";
            }
        }

        if(isset($A_getParams['cooking_time'])) {
            $I_time = intval($A_getParams['cooking_time']);
            $S_sql = $S_sql . " and cooking_time <= $I_time ";
        }

        if(isset($A_getParams['costs'])) {
            $S_sql = $S_sql . " and ";
            foreach ($A_getParams['costs'] as $S_type) {
                $S_sql = $S_sql . "cost = '$S_type' or ";
            }
            $S_sql = substr($S_sql, 0, -3);
        }

        if(isset($A_getParams['difficulties'])) {
            $S_sql = $S_sql . " and ";
            foreach ($A_getParams['difficulties'] as $S_difficulty) {
                $S_sql = $S_sql . "difficulty = '$S_difficulty' or";
            }
            $S_sql = substr($S_sql, 0, -3);
        }

        echo $S_sql;
        $O_con = Connection::initConnection();
        $sth = $O_con->prepare($S_sql);

        $sth->bindValue(':search', $S_search, PDO::PARAM_STR);

        $sth->execute();
        return ($sth->fetchAll());
    }
}