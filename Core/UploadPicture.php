<?php

final class UploadPicture
{

    static function createPictureName(string $projectName): string
    {
        return strtolower(preg_replace("/[^A-Za-z1-9]/", "", iconv('UTF-8', 'ASCII//TRANSLIT', $projectName)));
    }

    static function uploadPicture($elementName, $isRecipe)
    {
        if (isset($_FILES['picture'])) {
            $elementName = self::createPictureName($elementName);

            $extensions = ['jpg', 'jpeg','png'];
            $maxSize = 5000000;

            $tmpName = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $size = $_FILES['picture']['size'];
            $error = $_FILES['picture']['error'];
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $file = $elementName . '.' . $extension;

                if($isRecipe) {
                    move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . "/static/content/recipes/" . $file);
                    return "/static/content/recipes/". $file;
                }
                move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . "/static/content/users/" . $file);
                return "/static/content/users/". $file;
            }
        }
        return null;
    }
}