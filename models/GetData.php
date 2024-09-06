<?php

namespace app\models;

use app\models\db\Companys;
use Yii;

/**
 * @package app\models
 */
class GetData
{
    /**
     * Получение данных по организации, в которой состоит пользователь
     *
     * @return array|false|\yii\db\ActiveRecord|null
     */
    public static function getCompanyDataByCurrentUser()
    {
        if (isset(Yii::$app->user->identity->company_name)){
            $company_id = Yii::$app->user->identity->company_name;
            return Companys::find()->where(['id' => $company_id])->one();
        }

        return false;
    }
}