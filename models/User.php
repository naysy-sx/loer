<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int    $id
 * @property string $email                 E-mail
 * @property string $username              Имя пользователя
 * @property string $second_name           Имя пользователя
 * @property string $family                Имя пользователя
 * @property string $password_hash         Пароль пользователя
 * @property string $password_reset_token  Токен на восстановление пароля
 * @property string $auth_key              Уникальный ключ авторизации
 * @property int    $status                Статус пользователя
 * @property int    $type_user                Тип пользователя // Один пользователь -1  / компания -2
 * @property string $city                  Город пользователя
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $company_name
 * @property int    $type
 * @property string $position
 * @property string $phone
 * @property int    $show_arrival_price
 * @property int    $change_arrival
 * @property string $my_cashboxes
 * @property string $my_warehouses
 * @property string $my_company
 * @property int    $demo
 * @property int    $subscribe             2 = отказ от рассылки
 * @property int    $acc_level
 * @property int    $activity              Вид деятельности
 * @property int    $mail_free             Рассылок осталось
 * @property string $second_mail
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 10;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @param $email
     *
     * @return User|null
     */
    public static function findByEmail($email)
    {
        return static::findOne([
            'email'  => $email,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [
                [
                    'password_hash',
                    'auth_key',
                    'created_at',
                    'updated_at',
                    'company_name',
                ],
                'required',
            ],
            // 'email',
            [
                [
                    'status',
                    'type_user',
                    'created_at',
                    'updated_at',
                    'type',
                    'show_arrival_price',
                    'change_arrival',
                    'demo',
                    'subscribe',
                    'acc_level',
                    'activity',
                    'mail_free',
                ],
                'integer',
            ],
            [
                [
                    'email',
                    'username',
                    'password_hash',
                    'password_reset_token',
                    'city',
                    'company_name',
                    'second_name',
                    'family',
                    'second_mail',
                ],
                'string',
                'max' => 255,
            ],
            [
                [
                    'auth_key',
                    'position',
                    'phone',
                    'my_cashboxes',
                    'my_warehouses',
                    'my_company',
                ],
                'string',
                'max' => 255,
            ],
            [
                ['email'],
                'unique',
            ],
        ];
    }

    /**
     * @param int|string $id
     *
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id'     => $id,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param mixed $token
     * @param null  $type
     *
     * @return void|IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param $username
     *
     * @return User|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'email'  => $username,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param $token
     *
     * @return User|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status'               => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire    = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Получение имени пользователя по его id
     *
     * @param $user_id
     *
     * @return mixed|null
     */
    public static function getUserNameById($user_id)
    {
        return self::find()->where(['id' => $user_id])->one()->username;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     *
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $password
     *
     * @return bool
     */
    public function validatePassword($password)
    {
        if (Encryption::encWOK($password) == $this->password_hash) {
            return true;
        }

        return false;
    }

    /**
     * @param $password
     *
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        //$this->password_hash = Yii::$app->security->generatePasswordHash($password);
        $this->password_hash = $password;
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Получение имени юзера по его id
     *
     * @param $id
     *
     * @return mixed
     */
    public static function getNameById($id)
    {
        return self::find()
                   ->where(['id' => $id])
                   ->asArray()
                   ->one()['username'];
    }

    /**
     * Получение имени и фамилии юзера по его id
     *
     * @param $id
     *
     * @return mixed
     */
    public static function getNameNFamilyById($id)
    {
        $u_fio = self::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();

        return $u_fio['username'] . ' ' . $u_fio['family'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email'       => 'Логин',
            'username'    => 'Имя',
            'second_name' => 'Отчество',
            'family'      => 'Фамилия',
            'city'        => 'Город',
            'name'        => 'ФИО',
            'birthday'    => 'Дата рождения',
            'level'       => 'Уровень в системе',
            'sex'         => 'Пол',
            'ac_customer' => 'Разрешенные заводы',
            'ac_shop'     => 'Разрешенные цеха',

            'password_hash'        => 'Пароль',
            'password_reset_token' => 'Токен сброса пароля',
            'auth_key'             => 'Ключ авторизации',
            'status'               => 'Статус',
            'type_user'               => 'Тип пользователя',
            'created_at'           => 'Создан',
            'updated_at'           => 'Отредактирован',

            'type'     => 'Тип учетки - директор/сотрудник',
            'position' => 'Должность',
            'phone'    => 'Телефон',

            'show_arrival_price' => 'Показывать закупочные ценны этому сотруднику',
            'change_arrival'     => 'Разрешить вносить изменения в приход',
            'my_cashboxes'       => 'Разрешенные кассы',
            'my_warehouses'      => 'Разрешенные склады',
            'my_company'         => 'Разрешенные компании',

            'second_mail' => 'Контактный адрес почты (должен отличаться от используемого при регистрации)',
        ];
    }

    /**
     * Обновление Auth-Key после авторизации
     *
     * @param $user_id
     *
     * @return bool
     */
    public static function generateNewAuthKey($user_id)
    {
        $new_auth_key = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        /** @var User $current_user */
        $current_user             = User::find()->where(['id' => $user_id])->one();
        $current_user->auth_key   = $new_auth_key;
        $current_user->updated_at = time();
        $current_user->save();

        return true;
    }
}