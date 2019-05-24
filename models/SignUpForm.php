<?php
namespace app\models;

use yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $password;

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

    /*
     * При успешной валидации добавляет пользователя в БД
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
?>