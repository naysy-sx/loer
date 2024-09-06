<?php
namespace app\models\logical;

class ImageIcons
{
    public static function getIcon($filename)
    {
        $data = explode('.', $filename);
        $file_ext = end($data);

        // если картинка
        if ($file_ext == 'jpg'){
            return "<i class='fa fa-image' aria-hidden='true'></i>";
        }

        // если док


        // если файл не определен
        return "<i class='fa fa-file' aria-hidden='true'></i>";
    }
}