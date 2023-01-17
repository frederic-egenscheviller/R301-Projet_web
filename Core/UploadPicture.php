<?php

final class UploadPicture
{
    static function createPicturesDirectory(): void
    {
        if (!file_exists("../content")) {
            mkdir("../content", 0777, true);
        }
    }
    static function createPictureName(string $projectName): string
    {
        return strtolower(preg_replace("/[^A-Za-z]/", "", iconv('UTF-8', 'ASCII//TRANSLIT', $projectName)));
    }

    static function uploadPicture($elementName)
    {
        if (isset($_FILES['miniature'])) {
            $elementName = self::createPictureName($elementName);

            $extensions = ['jpg', 'jpeg'];
            $maxSize = 5000000;

            $tmpName = $_FILES['miniature']['tmp_name'];
            $name = $_FILES['miniature']['name'];
            $size = $_FILES['miniature']['size'];
            $error = $_FILES['miniature']['error'];
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $file = $elementName . $extension;
                self::createPicturesDirectory();
                move_uploaded_file($tmpName, "../content/" . $file);
                return "../content/". $file;
            }
        }
        return null;
    }
}