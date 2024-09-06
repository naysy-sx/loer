<?php

namespace app\models;

/**
 * @package app\models
 */
class Encryption
{
    /**
     * @param $pass
     *
     * @return string
     */
    public static function encWOK($pass): string
    {
        $password = "Ha873ogsygp9dof83uasdkfjg23qSDAsf";

        return openssl_encrypt($pass, "AES-128-ECB", $password);
    }

    /**
     * @param $string
     *
     * @return false|string
     */
    public static function enc($string)
    {
        $password = "Ha873ogsygp9dof83uasdkfjg23qSDAsf";

        return openssl_encrypt($string, "AES-128-ECB", $password);
    }

    /**
     * @param $string
     *
     * @return false|string
     */
    public static function deenc($string)
    {
        $password = "Ha873ogsygp9dof83uasdkfjg23qSDAsf";

        return openssl_decrypt($string, "AES-128-ECB", $password);
    }
}