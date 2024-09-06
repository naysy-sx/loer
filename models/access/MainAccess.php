<?php

namespace app\models\access;

use Yii;

/**
 * Модель контроля доступа
 * @package app\models\access
 */
class MainAccess
{
    /**
     * Если не авторизован - выкидывать н страницу авторизации
     */
    public static function ifGuestGoHome()
    {
        if (Yii::$app->user->isGuest) {
            header("Location: index.php?r=site/login");
            exit;
        }
    }
}