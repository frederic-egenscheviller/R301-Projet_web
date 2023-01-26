<?php

/**
 * Class Appreciation
 *
 * This class represents the Appreciation table in the DB and communicates with it
 */
class Appreciation extends Model
{
    /**
     * Selects all the appreciations of a user
     *
     * @param string $S_id The id of the user
     * @return array The array of the user's appreciations
     */
    public static function selectAppreciationByUser(string $S_id) : array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM Appreciation WHERE user_id = :user";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':user', $S_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }

    /**
     * Selects all the appreciations of a recipe
     *
     * @param string $S_recipe_id The id of the recipe
     * @return array The array of the recipe's appreciations
     */
    public static function selectAllByRecipeId(string $S_recipe_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM APPRECIATION WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$S_recipe_id);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }
}