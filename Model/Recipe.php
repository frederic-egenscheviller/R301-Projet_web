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


    public static function goodStringForSql(array $A_parms):string{
        $S_goodString = "";
        foreach($A_parms as $S_elem){
            $S_goodString .= "'".$S_elem."'";
        }
        return substr($S_goodString,0,-2);
    }


    public static function searchRecipe(array $A_getParams):array{

        $S_listIngredient = $A_getParams['ingredients'] ? self::goodStringForSql($A_getParams['ingredients']) : "select * from ingredients";
        $S_listUtensil = $A_getParams['utensil'] ?  self::goodStringForSql($A_getParams['utensils']): "select * from utensils";
        $S_listParticularity = $A_getParams['particularity'] ? self::goodStringForSql($A_getParams['particularities']) : "select * from particularities";
        $S_search = $A_getParams['search'] ? $A_getParams['search'] : "";
        
        $S_sql = "SELECT distinct r.* 
                    FROM Recipe r, Ingredients_recipe i, Utensils_recipe u, Particularities_recipe p
                    WHERE r.name LIKE'%:search%'
                    AND r.id = i.recipe_id
                    AND i.ingredient_id IN (:listIngredient)
                    AND r.id = u.recipe_id
                    AND u.utensil_id IN (:listUstensil)
                    AND r.id = p.recipe_id
                    AND p.particularity_id IN (:listParticularity);";
        
        $O_con = Connection::initConnection();
        $sth = $O_con->prepare($S_sql);
        $sth->execute();
        $sth->bindValue(':search', $S_search, PDO::PARAM_STR);
        $sth->bindValue(':listIngredient', $S_listIngredient, PDO::PARAM_STR);
        $sth->bindValue(':listUstensil', $S_listUtensil, PDO::PARAM_STR);
        $sth->bindValue(':listParticularity', $S_listParticularity, PDO::PARAM_STR);
        return $sth->fetchAll();
    }

}