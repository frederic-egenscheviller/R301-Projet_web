<?php
class Users extends Model{
    public static function uploadUserPicture(string $S_name):string{
        return UploadPicture::upload($S_name . Users::selectHowMany() ,false);
    }

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