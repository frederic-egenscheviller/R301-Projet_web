<?php

/**
 * Class Ingredients
 *
 * This class represents the Ingredients table in the DB and communicates with it.
 */
class Ingredients extends Model
{
    /**
     * Selects all Ingredient ids and quantities from the Ingredients table
     *
     * @param int $I_recipe_id The id of the recipe
     *
     * @return array Result of the select query
     */
    public static function selectAllByRecipeId(int $I_recipe_id):array
    {
        $P_db = Connection::initConnection();
        $S_sql = "SELECT ingredient_id, quantity FROM INGREDIENTS_RECIPE WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }

    /**
     * Deletes all Ingredients and quantities from the Ingredients table
     *
     * @param int $I_recipe_id The id of the recipe
     *
     * @return array Result of the select query
     */
    public static function deleteAllByRecipeId(int $I_recipe_id):array
    {
        $P_db = Connection::initConnection();
        $S_sql = "DELETE FROM INGREDIENTS_RECIPE WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }
}