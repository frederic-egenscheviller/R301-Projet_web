<?php

/**
 * Class Connection
 *
 * This class is responsible for creating the connection with the database.
 */
final class Connection
{
    /**
     * Establish connection with the database
     *
     * @param string $host The hostname of the database
     * @param string $user The username of the database
     * @param string $password The password of the database
     *
     * @return PDO|null The PDO connection
     */
    public static function connect(String $host,String $user,String $password) : PDO
    {
        try
        {
            $bdd = new PDO("pgsql:host=$host; port=5432; dbname=$user; user=$user; password=$password");
            return $bdd;
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    /**
     * Initialize the connection with the database
     *
     * @return PDO|null The PDO connection
     */
    public static function initConnection() : PDO
    {
        return Connection::connect("mel.db.elephantsql.com","betwmtzu","e-XKrb3aY50rWfRQele2Z_17ieTeY3e1");
    }

}