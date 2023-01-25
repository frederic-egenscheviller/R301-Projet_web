<?php
class Users extends Model{
    public static function uploadUserPicture(string $name):string{
        return UploadPicture::uploadPicture($name . Users::selectHowMany() ,false);
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
        $O_con = Connection::initConnection();
        $S_sql = "UPDATE USERS SET last_login = :last_login WHERE id = :id";
        $sth = $O_con->prepare($S_sql);
        $sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $sth->bindValue(':last_login', date("Y-m-d"));
        $sth->execute();
        return $sth->fetch();
    }
}