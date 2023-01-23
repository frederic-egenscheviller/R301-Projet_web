<?php

class Recipe extends Model
{

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

        $S_listIngredient = isset($A_getParams['ingredients']) ? "'".implode("', '",$A_getParams['ingredients'])."'" : "select * from ingredients";
        $S_listUtensil = isset($A_getParams['utensil']) ?  "'".implode("', '",$A_getParams['utensils'])."'": "select * from utensils";
        $S_listParticularity = isset($A_getParams['particularity']) ? "'".implode("', '",$A_getParams['particularities'])."'" : "select * from particularities";

        $S_search = isset($A_getParams['search']) ? $A_getParams['search'] : "";

        $S_listDifficulty = isset($A_getParams['difficulty']) ? "'".implode("', '",$A_getParams['difficulty'])."'": "'facile','moyen','difficile'";
        $S_listcost = isset($A_getParams['cost']) ? "'".implode("', '",$A_getParams['cost'])."'": "'Bon marché','Abordable','Coûteux'";
        $I_cookingTime = isset($A_getParams['cookingTime']) ? intval($A_getParams['cookingTime']) : 1000000;
        
        $S_sql = "SELECT distinct r.* 
                    FROM Recipe r, Ingredients_recipe i, Utensils_recipe u, Particularities_recipe p
                    WHERE r.name LIKE'%:search%'
                    AND r.id = i.recipe_id
                    AND i.ingredient_id IN (:listIngredient)
                    AND r.id = u.recipe_id
                    AND u.utensil_id IN (:listUstensil)
                    AND r.id = p.recipe_id
                    AND p.particularity_id IN (:listParticularity)
                    AND r.difficulty IN (:listDifficulty)
                    AND r.cost  IN (:listcost)
                    AND r.cooking_time < :cookingTime;";
        
        $O_con = Connection::initConnection();
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        $sth->bindValue(':search', $S_search, PDO::PARAM_STR);
        $sth->bindValue(':listIngredient', $S_listIngredient, PDO::PARAM_STR);
        $sth->bindValue(':listUstensil', $S_listUtensil, PDO::PARAM_STR);
        $sth->bindValue(':listParticularity', $S_listParticularity, PDO::PARAM_STR);
        $sth->bindValue(':listDifficulty', $S_listDifficulty, PDO::PARAM_STR);
        $sth->bindValue(':listcost', $S_listcost, PDO::PARAM_STR);
        $sth->bindValue(':cookingTime', $I_cookingTime, PDO::PARAM_INT);
        return $sth->fetchAll();
    }

}