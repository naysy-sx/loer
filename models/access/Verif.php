<?php

namespace app\models\access;

/**
 * Модель верификации
 * @package app\models\access
 */
class Verif
{
    public int $user_id;
    public int $company_id;

    /**
     * @return bool
     */
    public function start(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getAccess(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getStaffs(): bool
    {
        //$users = User::find()->where();

        return true;
    }

    /**
     * @return bool
     */
    public function getRules(): bool
    {
        return true;
    }
}