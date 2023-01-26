<?php

/**
 * Class Particularities
 *
 * This class represents the Particularities table in the DB and communicates with it
 */
class Particularities extends Model{

    /**
     * Select all particularities of a recipe
     *
     * @param int $I_recipe_id Id of the recipe
     * @return array Result of the query
     */
    public static function selectAllByRecipeId(int $I_recipe_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT particularity_id FROM particularities_RECIPE WHERE recipe_id = :recipe_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth -> bindParam(':recipe_id',$I_recipe_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result =$P_sth->fetchAll();
        $P_db = null;
        return $A_result;
    }
}