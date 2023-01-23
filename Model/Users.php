<?php
class Users extends Model{
    public static function uploadUserPicture(string $name):string{
        return UploadPicture::uploadPicture($name . Users::selectHowMany() ,false);
    }

    public static function isUser(array $A_getParams):string{
        $S_id = $A_getParams['id'];

        $A_user = self::selectById($S_id);
        if (($A_user) && ($A_user['password']==$A_getParams['password'])) {
            if(Admin::selectById($S_id)) {
                return 'admin';
            }
            return 'user';
        }
        return 'visitor';
    }


}