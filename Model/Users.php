<?php
class Users extends Model{
    public static function uploadUserPicture(array $A_getParams):string{
        return UploadPicture::uploadPicture($A_getParams);
    }
}