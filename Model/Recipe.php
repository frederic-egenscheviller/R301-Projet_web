<?php

/**
 * Class Recipe
 *
 * This class represents the Recipe table in the DB and communicates with it
 */
class Recipe extends Model{

    /**
     * Formats a string to have only alphanumeric characters, no accents
     *
     * @param string $S_oldName The string to be formatted
     * @return string The formated string
     */
    public static function goodRecipeName(string $S_oldName) : string{
        // convert special characters to HTML entities
        $S_newName = htmlentities($S_oldName, ENT_NOQUOTES, 'utf-8');
        // replace single-character entities with the character
        $S_newName = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $S_newName);
        // replace ligature entities with the character
        $S_newName = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $S_newName);
        // remove any remaining HTML entities
        return preg_replace('#&[^;]+;#', '', $S_newName);
    }

    /**
     * Delete all the elements related to a recipe in the database
     *
     * @param int $I_recipeId The id of the recipe
     * @return bool true if the deletion is successful, false otherwise
     */
    public static function deleteRecipeElem(int $I_recipeId) : bool{

        $P_db = Connection::initConnection();
        try{
            $S_sql = "delete from ingredients_recipe where recipe_id = :id";
            $P_sth = $P_db->prepare($S_sql);
            $P_sth->bindValue(':id', $I_recipeId, PDO::PARAM_INT);
            $P_sth->execute();
        
            $S_sql = "delete from utensils_recipe where recipe_id = :id";
            $P_sth = $P_db->prepare($S_sql);
            $P_sth->bindValue(':id', $I_recipeId, PDO::PARAM_INT);
            $P_sth->execute();
        
            $S_sql = "delete from particularities_recipe where recipe_id = :id";
            $P_sth = $P_db->prepare($S_sql);
            $P_sth->bindValue(':id', $I_recipeId, PDO::PARAM_INT);
            $P_sth->execute();
        
        }catch(Exception $e){
            return false;
        }
            return true;
        }

    /**
     * Update a recipe in the database according to an array of parameters
     *
     * @param array $A_postParams An array containing the parameters of the recipe : id, name, cooking_time, difficulty, cooking_type, cost, preparation_description, picture, ingredients, quantities, utensils, particularities
     * @return bool true if the update was successful, false otherwise
     */
    public static function updateRecipe(array $A_postParams) : bool{

            $I_recipeId = intval($A_postParams['id']);

            $A_paramRecipe = array('id' => $A_postParams['id'], 'name' => $A_postParams['name'], 'cooking_time' => $A_postParams['cooking_time'], 
            'difficulty' => $A_postParams['difficulty'], 'cooking_type' => $A_postParams['cooking_type'], 'cost'=> $A_postParams['cost'],
            'preparation_description'=>$A_postParams['preparation_description']);
            

            if(isset($A_postParams['picture'])){   
                $A_paramRecipe['picture'] = $A_postParams['picture'];
            }

            $B_flag = self::updateById($A_paramRecipe,$I_recipeId);
            
            if(self::deleteRecipeElem($I_recipeId)){
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
            else{
                return false;
            }
            return $B_flag;
        }

    /**
     * Add a new element to a recipe
     *
     * @param int $I_recipeId The ID of the recipe
     * @param array $A_params The array of elements to add
     * @param string $S_table The name of the table to add the elements to
     *
     * @return bool True if the elements were added, False otherwise
     */
    public static function addRecipeElem(int $I_recipeId ,array $A_params, string $S_table):bool{
        
        $P_db = Connection::initConnection();
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
            
            $P_sth = $P_db->prepare($S_sql);
            $P_sth->bindValue(':elem', $S_elem, PDO::PARAM_STR);
            $P_sth->bindValue(':recipe', $I_recipeId, PDO::PARAM_STR);
            $P_sth->execute();
        }
        return true;
    }

    /**
     * Adds a recipe ingredient
     *
     * @param int $I_recipeId the id of the recipe
     * @param array $A_listIngredients a list of ingredients
     * @param array $A_listQuantities a list of quantities
     *
     * @return bool true if the ingredient was added, otherwise false
     */
    public static function addRecipeIngredient(int $I_recipeId ,array $A_listIngredients, array $A_listQuantities):bool{
        
        $P_db = Connection::initConnection();
        $I_sizeOfArray = sizeof($A_listIngredients);
        for($I_i = 0; $I_i < $I_sizeOfArray; $I_i++){
            try{
                Ingredients::create(array('id' => $A_listIngredients[$I_i]));
            }catch(Exception $e){}
            
            $S_sql = "insert into ingredients_recipe values (:recipe, :elem, :quantity)";
            $P_sth = $P_db->prepare($S_sql);
            $P_sth->bindValue(':quantity', $A_listQuantities[$I_i], PDO::PARAM_STR);
            $P_sth->bindValue(':elem', $A_listIngredients[$I_i], PDO::PARAM_STR);
            $P_sth->bindValue(':recipe', $I_recipeId, PDO::PARAM_STR);
            $P_sth->execute();
        }
         return true;
    }

    /**
     * Creates a new recipe in the database
     *
     * @param array $A_postParams The POST parameters from the form
     *
     * @return string A message indicating the success of the recipe creation
     */
    public static function createRecipe(array $A_postParams):string{
        $P_db = Connection::initConnection();
        $S_sql = "INSERT INTO RECIPE (name, picture, preparation_description, cooking_time, difficulty, cost, cooking_type, user_id)
        VALUES (:name, :picture, :preparation_description, :cooking_time, :difficulty, :cost, :cooking_type, :user_id)";
        $P_sth = $P_db->prepare($S_sql);
        $S_name  = strtoupper(self::goodRecipeName($A_postParams['name']));
        $P_sth->bindValue(':name', $S_name, PDO::PARAM_STR);
        $P_sth->bindValue(':picture', $A_postParams['picture'], PDO::PARAM_STR);
        $P_sth->bindValue(':preparation_description', $A_postParams['preparation_description'], PDO::PARAM_STR);
        $P_sth->bindValue(':cooking_time', $A_postParams['cooking_time'], PDO::PARAM_INT);
        $P_sth->bindValue(':difficulty', $A_postParams['difficulty'], PDO::PARAM_STR);
        $P_sth->bindValue(':cost', $A_postParams['cost'], PDO::PARAM_STR);
        $P_sth->bindValue(':cooking_type', $A_postParams['cooking_type'], PDO::PARAM_STR);
        $P_sth->bindValue(':user_id', Session::getSession()['id'], PDO::PARAM_STR);
        $B_flag = $P_sth->execute();

        if($B_flag){

            $S_sql = "select id from recipe where name = :name and preparation_description = :desc";
            $P_sth = $P_db->prepare($S_sql);
            $P_sth->bindValue(':name', $S_name, PDO::PARAM_STR);
            $P_sth->bindValue(':desc', $A_postParams['preparation_description'], PDO::PARAM_STR);
            $B_flag = $P_sth->execute();
            $A_recipe = $P_sth->fetch();
            $P_db=null;
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
        $S_result = $B_flag ? "Vous avez bien ajouté la recette" : "Erreur dans l'ajout de la recette";
        return $S_result;
    }

    /**
     * Returns an array of 3 random recipes from the database.
     *
     * @return array An array of 3 random recipes from the database.
     */
    public static function randomRecipe():array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM RECIPE ORDER BY RANDOM() LIMIT 3";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     * Selects a recipe from the database based on user id
     *
     * @param string $id The user id
     *
     * @return array The array of recipes
     */
    public static function selectRecipeByUser(string $id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM RECIPE WHERE user_id = :user";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':user', $id, PDO::PARAM_INT);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     *
     * Retrieves all distinct cooking times from the RECIPE table
     *
     * @return array Returns an array with all the retrieved cooking times
     */
    public static function selectCookingTimes(): array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COOKING_TIME FROM RECIPE";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     * Selects the distinct cooking types from the recipe table
     *
     * @return array An array of the cooking types
     */
    public static function selectCookingTypes(): array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COOKING_TYPE FROM RECIPE";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     * This method select the distinct difficulties from the recipe table
     *
     * @return array An array of the different difficulties
     */
    public static function selectDifficulties(): array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT DISTINCT DIFFICULTY FROM RECIPE";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     * Select the distinct costs of recipes from the database
     *
     * @return array An array of the distinct costs
     */
    public static function selectCosts(): array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT DISTINCT COST FROM RECIPE";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     * Selects the maximum id of the "RECIPE" table.
     *
     * @return string The maximum id of the "RECIPE" table.
     */
    public static function selectMaxId() : string{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT MAX(ID) FROM RECIPE";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->execute();
        return $P_sth->fetch()[0];
    }

    /**
     * Uploads a recipe picture
     *
     * @param string $name The name of the picture
     * @return string The name of the uploaded picture
     */
    public static function uploadRecipePicture(string $S_name):string{
        return UploadPicture::upload($S_name . (Recipe::selectMaxId() + 1), true);
    }

    /**
     * Updates a recipe picture by its id
     *
     * @param array $A_params The array of parameters
     *
     * @return string|null The picture name or null
     */
    public static function updateRecipePicture(array $A_params):?string{
        $S_id = $A_params['id'];
        return UploadPicture::upload(Recipe::selectById($S_id)['name'] . ($S_id), true);
    }

    /**
     *
     * Removes spaces, html entities and other special characters from a string
     *
     * @param string $S_oldString The string to be modified
     *
     * @return string The modified string
     */
    public static function goodString(string $S_oldString):string{
        $S_newString = str_replace(" ","",$S_oldString);
        $S_newString = htmlentities($S_newString, ENT_NOQUOTES, 'utf-8');
        $S_newString = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $S_newString);
        $S_newString = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $S_newString);
        return preg_replace('#&[^;]+;#', '', $S_newString);
    }

    /**
     * Adds a query to a given array
     *
     * @param string $S_table The database table
     * @param string $S_itemId The database table item id
     * @param array $A_items An array of items
     * @param array $A_paramBindValue The array to which the query will be added
     *
     * @return string The query
     */
    public static function addToQuery(string $S_table, string $S_itemId, array $A_items, &$A_paramBindValue) : string{
        $S_s = "and id in (SELECT RECIPE_ID FROM $S_table WHERE ";
        foreach ($A_items as $item){
            $itemBind = self::goodString($item);
            $S_s = $S_s."$S_itemId = :$itemBind and ";
            $A_paramBindValue[":$itemBind"] = array($item, PDO::PARAM_STR);
        }
        $S_s = substr($S_s, 0, -4) . ") ";
        return $S_s;
    }

    /**
     * Searches for recipes based on parameters
     *
     * @param array $A_getParams The parameters used for the search
     *
     * @return array An array containing the recipes that have been found
     */
    public static function searchRecipe(array $A_getParams): array{

        $S_sql = "SELECT distinct r.* FROM Recipe r WHERE r.name LIKE :search ";
        $S_search = isset($A_getParams['search']) ? "%" . strtoupper(self::goodRecipeName($A_getParams['search'])) . "%" : "%";
        
        $A_paramBindValue = array(':search' => array($S_search , PDO::PARAM_STR));

        if (isset($A_getParams['ingredients'])) {
            $S_sql = $S_sql . self::addToQuery('INGREDIENTS_RECIPE', 'INGREDIENT_ID', $A_getParams['ingredients'], $A_paramBindValue) ;
        }

        if (isset($A_getParams['particularities'])) {
            $S_sql = $S_sql . self::addToQuery('PARTICULARITIES_RECIPE', 'PARTICULARITY_ID', $A_getParams['particularities'],$A_paramBindValue);
        }

        if (isset($A_getParams['utensils'])) {
            $S_sql = $S_sql . self::addToQuery('UTENSILS_RECIPE', 'UTENSIL_ID', $A_getParams['utensils'],$A_paramBindValue);
        }

        if(isset($A_getParams['cooking_types'])){
            $S_sql = $S_sql . " and ";
            foreach ($A_getParams['cooking_types'] as $S_type) {
                $S_typeBind = self::goodString($S_type);
                $S_sql = $S_sql . " cooking_type = :$S_typeBind or ";
                $A_paramBindValue[":$S_typeBind"] = array($S_type, PDO::PARAM_STR);
            }
            $S_sql = substr($S_sql, 0, -3);
        }

        if(isset($A_getParams['cooking_time'])) {
            $I_time = intval($A_getParams['cooking_time']) > 0 ?  intval($A_getParams['cooking_time']) : 9999999;
            $S_sql = $S_sql . " and cooking_time <= :cooking_time ";
            $A_paramBindValue[":cooking_time"] = array($I_time, PDO::PARAM_INT);
        }

        if(isset($A_getParams['costs'])) {
            $S_sql = $S_sql . " and ";
            foreach ($A_getParams['costs'] as $S_cost) {
                if($S_cost == '€'){
                    $S_costBind = "paschere";
                }elseif ($S_cost == '€€'){
                    $S_costBind = "moyenchere";
                }else{
                    $S_costBind = "chere";
                }
                $S_sql = $S_sql . "cost = :$S_costBind or ";
                $A_paramBindValue[":$S_costBind"] = array($S_cost, PDO::PARAM_STR);
            }
            $S_sql = substr($S_sql, 0, -3);
        }

        if(isset($A_getParams['difficulties'])) {
            $S_sql = $S_sql . " and ";
            foreach ($A_getParams['difficulties'] as $S_difficulty) {
                $S_sql = $S_sql . "difficulty = :$S_difficulty or ";
                $A_paramBindValue[":$S_difficulty"] = array($S_difficulty, PDO::PARAM_STR);
            }
            $S_sql = substr($S_sql, 0, -3);
        }

        $P_db = Connection::initConnection();
        $P_sth = $P_db->prepare($S_sql);
        
        foreach ($A_paramBindValue as $key => $value) {
            $P_sth->bindValue($key, $value[0], $value[1]);
        }

        $P_sth->execute();
        return ($P_sth->fetchAll());
    }

    /**
     * Delete a recipe picture
     *
     * @param string $S_PathToPicture The path to the recipe picture
     *
     * @return bool True on success, false on failure
     */
    public static function deleteRecipePicture(string $S_PathToPicture): bool
    {
        return unlink($_SERVER['DOCUMENT_ROOT'].$S_PathToPicture);
    }
}