<?php

namespace app\components\services;

use Yii;

class FileService
{
    public string $relImgPath = "img/";

    /**
     * Загружает изображение на сервер - возвращает относительный путь
     *
     * @param string $tempPath
     * @param string $fileName
     * @return string|null
     */
    public function uploadImg(string $tempPath, string $fileName) : ?string
    {
        $uploadFilePath = $this->relImgPath . time() . $fileName;

        while (file_exists($uploadFilePath)) {
            $uploadFilePath = $this->relImgPath . time() . $fileName;
        }

        if (move_uploaded_file($tempPath, $uploadFilePath)) {
           return $uploadFilePath;
        }
        Yii::error('При загрузке изображения произошла ошибка в функции move_uploaded_file,
        загрузка происходила в путь '.$uploadFilePath);
        return null;
    }
}