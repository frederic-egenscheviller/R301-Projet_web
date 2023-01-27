<?php

/**
 * Class Utensils
 *
 * This class represents the Utensils table in the DB and communicates with it
 */
class Utensils extends Model{

    /**
     * Selects all utensils from the database by the recipe id
     *
     * @param int $I_recipe_id The id of the recipe
     *
     * @return array An array with the utensils
     */
    public static function selectAllByRecipeId(int $I_recipe_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT utensil_id FROM utensils_RECIPE WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result = $P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }

    /**
     * Deletes all utensils from the database by the recipe id
     *
     * @param int $I_recipe_id The id of the recipe
     *
     * @return array An array with the utensils
     */
    public static function deleteAllByRecipeId(int $I_recipe_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "DELETE FROM utensils_RECIPE WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result = $P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }
}