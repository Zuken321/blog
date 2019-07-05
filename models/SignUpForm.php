<?php
namespace app\models;

use yii\base\Model;

/**
 * Class SignUpForm
 *
 * Модель обрабатывает получаемые с формы данные
 *
 * @package app\models
 */
class SignUpForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Введенный логин уже занят.'],
            ['username', 'string', 'min' => 5, 'max' => 30],
            ['password', 'string', 'min' => 6, 'max' => 20],
        ];
    }

    /**
     * Добавляет пользователя в БД
     *
     * @return User|bool
     */
    public function signUp()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
