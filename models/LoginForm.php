<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;           // Имя пользователя
    public $password;           // Пароль
    public $rememberMe = false;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules() // Правила валидации
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() // Псевданимы полей формы
    {
        return [
            'username'   => 'Логин',     // Пользователь
            'password'   => 'Пароль',    // Пароль
            'rememberMe' => 'Запомнить', // Запомнить пользователя
        ];
    }

    /* --- Validate --- */

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) { // Проверка на наличие ошибок
            $user = $this->getUser(); // Вызов метода getUser()
            if (!$user || !$user->validatePassword($this->password)) { // Если обект user не создан или пароль не прошол валидацию
                $this->addError($attribute, 'Логин/пароль веден не верно'); // Вывод ошибки
            }
        }
    }

    /* --- /Validate --- */

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() // Авторизация пользователя
    {
        if ($this->validate()) { // Если валидация прошла успешно
            if ($this->rememberMe) { // Если нужно запомнить пользователя
                $u = $this->getUser(); // получить пользователя
                $u->generateAuthKey(); // Записать строку в "auth_key"
                $u->save(false); // ! Сохранить пользователя. При сохранении отключена валидация                
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0); // Произвести авторизацию пользователя, пользователь сохраняется на 30 дней
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() // Получить пользователя
    {
        if ($this->_user === false) { // Если пользователь не авторизации
            $this->_user = User::findByUsername($this->username); // Найти пользователя
        }

        return $this->_user; // вернуть пользователя или false
    }
}