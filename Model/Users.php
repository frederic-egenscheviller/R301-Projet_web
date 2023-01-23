<?php
class Users extends Model{
    public static function uploadUserPicture(array $A_getParams):string{
        return UploadPicture::uploadPicture($A_getParams);
    }

    public static function isUser(array $A_getParams):array{
        $S_id = $A_getParams['id'];
        $A_user = self::selectById($S_id);
        $A_admin = Admin::selectById($S_id);
        return array('user'=>$A_user['password']==$A_getParams['password'], 'admin'=>sizeof($A_admin)!=0);
    }


}