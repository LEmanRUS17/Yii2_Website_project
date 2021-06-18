<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\modules\admin\models\Comment;

/**
 * This is the model class for table "user".
 *
 * @property int         $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property int|null    $isAdmin
 * @property string|null $photo
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_UPDATE   = 'update';

    public $password_repeat = null;
    public $currentUsername;
    public $currentEmail;
    public $image;   // Изображение

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() // Правила валидации
    {
        return [
            [['username', 'password', 'password_repeat'], 'required', 'on' => self::SCENARIO_REGISTER], // Имя, пароль              | Обязательны
            ['email', 'required', 'on' => self::SCENARIO_REGISTER],                                     // Email                    | Обязательны
            ['username', 'string', 'min' => 5, 'max' => 255, 'on' => self::SCENARIO_REGISTER],          // Имя, пароль              | Строка длиной не более 255 символов
            ['username', 'validateUniqueUser', 'on' => self::SCENARIO_REGISTER],                        // Имя                      | Проверка валидатором validateUniqueUser
            ['email', 'validateUniqueEmail', 'on' => self::SCENARIO_REGISTER],                          // Email                    | Проверка валидатором validateUniqueEmail
            [['email', 'password'],                                                                     // Email, пароль            |
                'filter',                                                                               //                          | Фильтр
                'filter' => 'trim',                                                                     //                          | Обрезает пробелы вокруг
                'skipOnArray' => true, 'on' => self::SCENARIO_REGISTER],                                //                          | пропускать валидацию, если входящим значением является массив
            ['email', 'email', 'on' => self::SCENARIO_REGISTER],                                        // Email                    | Email
            [['password', 'password_repeat'],                                                           // Пароль, Повторить пароль |
                'compare', 'compareAttribute' => 'password',                                            //                          | имя атрибута, с которым нужно сравнить значение
                'operator' => '==',                                                                     //                          | Проверка двух значений на эквивалентность
                'message' => 'Пароли не совпадают', 'on' => self::SCENARIO_REGISTER],                   //                          | Вывод сообщение в случаи сробатывания валидатора
            ['password', 'string', 'min' => 6, 'max' => 30, 'on' => self::SCENARIO_REGISTER],           // Имя, пароль              | Строка длиной не более 255 символов
            ['description', 'string', 'max' => 300, 'on' => self::SCENARIO_REGISTER],                   // Описание                 | Строка, максимальная длина 300 символов

            [['username', 'email'], 'required', 'on' => self::SCENARIO_UPDATE],              // Имя, Email | Обязательны
            ['username', 'string', 'min' => 5, 'max' => 255, 'on' => self::SCENARIO_UPDATE], // Имя        | Строка длиной не более 255 символов
            ['email', 'validateUniqueEmail', 'on' => self::SCENARIO_UPDATE],                 // Email      | Проверка валидатором validateUniqueEmail
            ['email',                                                                        // Email      |
                'filter',                                                                    //            | Фильтр
                'filter' => 'trim',                                                          //            | Обрезает пробелы вокруг
                'skipOnArray' => true, 'on' => self::SCENARIO_UPDATE],                       //            | пропускать валидацию, если входящим значением является массив
            ['email', 'email', 'on' => self::SCENARIO_UPDATE],                               // Email      | Email
            ['description', 'string', 'max' => 300, 'on' => self::SCENARIO_UPDATE],          // Описание   | Строка, максимальная длина 300 символов
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() // Псевданимы полей формы
    {
        return [
            'id'              => 'ID',
            'username'        => 'Имя пользователя',
            'email'           => 'E-mail',
            'password'        => 'Пароль',
            'role'            => 'Тип акаунта',
            'password_repeat' => 'Повторите пароль',
            'description'     => 'Краткое описание',
            'image'           => 'Фото пользователя',
        ];
    }

    /* --- image --- */
    public function behaviors() // Функция необходимая для работы с изображениями
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function upload() // Обновление изображения на сервере
    {
        if ($this->validate()) {
            $path = 'upload/user_avatar/' . $this->image->baseName . '.' . $this->image->extension; // Путь сохранения
            $this->image->saveAs($path);     // Сохранить изображение
            $this->attachImage($path, true); // Записать в БД
            unlink($path); // Удаление картинки
            return true;
        } else {
            return false;
        }
    }
    /* --- /image --- */

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments() // Связь с таблицей Comment (один — много (1:М))
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id) // Получение пользователя по его id
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // return static::findOne(['access_token' => $token]);
    }

    public function getId() // Получить id
    {
        return $this->id;
    }

    public function getAuthKey() // Получить куки
    {
        return $this->auth_key;
    }

    public static function findByUsername($username) // Получить имя пользователя
    {
        return static::findOne(['username' => $username]);
    }

    /* --- Validate --- */
    public function validateAuthKey($authKey) // Валидация куки
    {
        return $this->auth_key === $authKey; // Запись $authKey в таблицу
    }

    public function validatePassword($password) //  Валидация пароля
    {
        return (Yii::$app->getSecurity()->validatePassword($password, $this->password)) ? true : false;
    }

    public function validateUniqueUser($attribute) // Валидация Имени пользователя на уникальность
    {
        if ($this->currentUsername != $this->username) { // Если старый и новый username не совпадают
            $users = $this->getTableListUser('username');                                       // Получить список пользователей
            $this->matchingSearch($attribute, $this->username, $users, 'Этот логин уже занят'); // Проверка на совпадение
        }
    }

    public function validateUniqueEmail($attribute) // Проверка Email пользователя на уникальность 
    {
        if ($this->currentEmail != $this->email) { // Если старый и новый email не совпадают
            $emails = $this->getTableListUser('email');                                       // Получить список пользователей
            $this->matchingSearch($attribute, $this->email, $emails, 'Эта почта уже занята'); // Проверка на совпадение
        }
    }
    /* --- /Validate --- */

    /* --- Helper functions --- */
    private function getTableListUser($column)
    { // Массив содержимого столбца
        return User::find()->select($column)->asArray()->column(); // Вернуть содержимое столбца в виде массива
    }

    private function matchingSearch($attribute, $elem, $array, $message = 'Element already exists') // Поиск соответствия в массиве (Валидируемый элемент, веденный элемент, массив в котором искать, сообщение об ошибке)
    {
        foreach ($array as $arrayElement) { // Перебрать массив
            if ($arrayElement == $elem) // Сравнение элемента массива и переданного элемента
                $this->addError($attribute, $message); // Сообщение об ошибке если совподение найдено
        }
    }
    
    public function generateAuthKey() // Генерация строки для куки
    {
        $this->auth_key = Yii::$app->security->generateRandomString(32); // Генерация строки на 32 символа
    }
    /* --- /Helper functions --- */
}
