<?php

class Recipe extends Model
{
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

}