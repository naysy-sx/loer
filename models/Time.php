<?php

namespace app\models;

/**
 * Работа с временем
 * @package app\models
 */
class Time
{
    /**
     * Перевод в метку linux
     *
     * @param $human_time
     *
     * @return bool
     */
    public function convertToLinux($human_time)
    {
        if (is_string($human_time)) {
            $human_time = explode('-', $human_time);
            $year = $human_time[0];
            $month = $human_time[1];
            $day = $human_time[2];

            if ($year && $month && $day) {
                return mktime(0, 0, 0, $month, $day, $year);
            }

            return false;
        }

        return false;
    }

    /**
     * Перевод в человекочитаемый формат
     *
     * @param $linux_time
     *
     * @return bool
     */
    public function convertToHuman($linux_time)
    {
        return date('H:i:s d.m.Y', $linux_time);
    }

    /**
     * Определение "времени назад"
     *
     * @param $linux_time
     *
     * @return bool
     */
    public function getTimesAGo($linux_time)
    {
        $timestap_now = time();

        if ($timestap_now > ($linux_time) && $timestap_now < ($linux_time + 60)) {
            return 'Минуту назад';
        }

        if ($timestap_now > ($linux_time + 61) && $timestap_now < ($linux_time + 120)) {
            return '2 минуты назад';
        }

        if ($timestap_now > ($linux_time + 121) && $timestap_now < ($linux_time + 180)) {
            return '3 минуты назад';
        }

        if ($timestap_now > ($linux_time + 181) && $timestap_now < ($linux_time + 300)) {
            return '5 минут назад';
        }

        if ($timestap_now > ($linux_time + 301) && $timestap_now < ($linux_time + 600)) {
            return '10 минут назад';
        }

        if ($timestap_now > ($linux_time + 601) && $timestap_now < ($linux_time + 1800)) {
            return 'Меньше полу часа назад';
        }

        if ($timestap_now > ($linux_time + 1801) && $timestap_now < ($linux_time + 3600)) {
            return 'Меньше часа назад';
        }

        if ($timestap_now > ($linux_time + 3601) && $timestap_now < ($linux_time + 10000)) {
            return 'Сегодня';
        }

        // todo: добавить "вчера / сегодня"

        return $this->convertToHuman($linux_time);
    }

    public static function convertUSA($date)
    {
        $temp = 0;

        if (is_string($date)) {
            $human_time = explode('-', $date);
            $year = $human_time[0];
            $month = $human_time[1];
            $day = $human_time[2];

            if ($year && $month && $day) {
                $temp = mktime(0, 0, 0, $month, $day, $year);
            }

            return date('d.m.Y', $temp);
        }

        return false;
    }

    /**
     * Получение linuxtime на сегодня-утро
     *
     * @return false|int
     */
    public static function getStartCurrentDay()
    {
        $time_now = date('d.m.Y');
        $start_current_day = strtotime($time_now);

        return $start_current_day;
    }
}