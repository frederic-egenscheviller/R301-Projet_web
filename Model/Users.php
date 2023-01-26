<?php

/**
 * Class Users
 *
 * This class represents the Users table in the DB and communicates with it
 */
class Users extends Model{

    /**
     * Uploads a picture in the DB
     *
     * @param string $S_name the name of the user
     * @return string the name of the uploaded file
     */
    public static function uploadUserPicture(string $S_name):string{
        return UploadPicture::upload($S_name . Users::selectHowMany() ,false);
    }

    /**
     * Checks if the user is an admin, user or visitor
     *
     * @param array $A_getParams the user credentials
     * @return string if the user is an admin, user or visitor
     */
    public static function isUser(array $A_getParams):string{
        $S_id = $A_getParams['id'];

        $A_user = self::selectById($S_id);
        $S_password = hash('sha512', $A_getParams['password']);
        if ($A_user && $A_user['password']== $S_password) {
            if(Admin::selectById($S_id)) {
                return 'admin';
            }
            return 'user';
        }
        return 'visitor';
    }

    /**
     * Updates the last login of the user
     *
     * @param string $S_id the id of the user
     * @return array the updated user
     */
    public static function updateLastLogin(string $S_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "UPDATE USERS SET last_login = :last_login WHERE id = :id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $P_sth->bindValue(':last_login', date("Y-m-d"));
        $P_sth->execute();
        $A_result = $P_sth->fetch();
        $P_db = null;
        return $A_result;
    }

    /**
     * Selects a user by their user id
     *
     * @param string $S_user_id the user id
     * @return array the user
     */
    public static function selectByUserId(string $S_user_id) : array{
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT * FROM USERS WHERE USER_ID = :user_id ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':user_id', $S_user_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;
        return $A_row;
    }
}