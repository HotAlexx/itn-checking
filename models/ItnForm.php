<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class ItnForm
 * @package app\models
 */
class ItnForm extends Model
{
    public $itnCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['itnCode', 'required'],
            ['itnCode', 'validateItnCode'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'itnCode' => 'ИНН',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateItnCode($attribute)
    {
        if (!$this->hasErrors()) {

            if ($this->itnCode == '1') {
                $this->addError($attribute, 'Введеный код не является ИНН.');
            }
        }
    }

}
