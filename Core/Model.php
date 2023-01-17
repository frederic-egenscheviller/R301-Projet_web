<?php

final class Model{

    public static function selectById(String $id, String $S_className) : array{
        $db = Connection::initConnection();
        $stmnt = "SELECT * FROM $S_className WHERE ID = ? ";
        $sth = $db->prepare($stmnt);
        $sth->execute(array($id));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public static function deleteByID(String $id, String $S_className) : bool{
        $db = Connection::initConnection();
        $stmnt = "DELETE FROM $S_className WHERE ID = ? ";
        $sth = $db->prepare($stmnt);
        return $sth->execute(array($id));
    }

    public static function create(Array $A_postParams, String $S_className) : bool{
        $db = Connection::initConnection();

        $keys = " ";
        $vals = " ";
        foreach (array_keys($A_postParams) as &$key){
            $keys .= $key.",";
            $vals .= "?,";
        }
        $keys[-1] = " ";
        $vals[-1] = " ";

        $stmnt = "INSERT INTO $S_className ($keys) VALUES ($vals)";
        $sth = $db->prepare($stmnt);
        return $sth->execute(array_values($A_postParams));
    }

    public static function updateById(Array $A_postParams,String $id , String $S_className) : bool{
        $db = Connection::initConnection();

        $keys = "";
        foreach (array_keys($A_postParams) as &$key){
            $keys.= $key."= ? ,";
        }
        $keys[-1] = " ";

        $stmnt = "UPDATE $S_className SET ".$keys." WHERE ID = ?";
        $sth = $db->prepare($stmnt);
        array_push($A_postParams,$id);
        return $sth->execute(array_values($A_postParams));
    }

    public static function selectHowMany(String $S_className) : int{
        $db = Connection::initConnection();
        $stmnt = "SELECt count(*) FROM $S_className";
        $sth = $db->prepare($stmnt);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}