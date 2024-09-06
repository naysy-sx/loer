<?php

namespace app\models;

/**
 * Настройки проекта
 * @package app\models
 */
class Settings
{
    const PROJECT_NAME = 'Я.Юрист';

    /**
     * Шаблон отображения названия страницы
     * [имя страницы] - [название проекта]
     *
     * @param string $page_title
     *
     * @return string
     */
    public static function getPageTitle(string $page_title): string
    {
        return $page_title . ' - ' . self::PROJECT_NAME;
    }

    /**
     * Версия проекта (для синхронизации)
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return '1.094';
    }
}