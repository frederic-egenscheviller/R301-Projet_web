<?php

final class UploadPicture
{

    static function createPictureName(string $projectName): string
    {
        return strtolower(preg_replace("/[^A-Za-z1-9]/", "", iconv('UTF-8', 'ASCII//TRANSLIT', $projectName)));
    }

    static function upload(string $S_elementName, bool $B_isRecipe) : ?string
    {
        if (isset($_FILES['picture'])) {
            $S_elementName = self::createPictureName($S_elementName);

            $I_maxSize = 5000000;

            $S_tmpName = $_FILES['picture']['tmp_name'];
            $S_name = $_FILES['picture']['name'];
            $I_size = $_FILES['picture']['size'];
            $I_error = $_FILES['picture']['error'];
            $S_tabExtension = explode('.', $S_name);
            $S_extension = strtolower(end($S_tabExtension));
            if ($I_size <= $I_maxSize && $I_error == 0) {
                $S_file = $S_elementName . '.' . $S_extension;

                if($B_isRecipe) {
                    move_uploaded_file($S_tmpName, $_SERVER['DOCUMENT_ROOT'] . "/static/content/recipes/" . $S_file);
                    return "/static/content/recipes/". $S_file;
                }
                move_uploaded_file($S_tmpName, $_SERVER['DOCUMENT_ROOT'] . "/static/content/users/" . $S_file);
                return "/static/content/users/". $S_file;
            }
        }
        return null;
    }
}