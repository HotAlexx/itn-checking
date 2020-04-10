<?php

namespace app\models;

use yii\base\Model;

/**
 * Class ItnForm
 * @package app\models
 */
class ItnForm extends Model
{
    const SELF_EMPLOYED = 1;
    const NOT_SELF_EMPLOYED = 0;

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
     * Validation Itn Code
     *
     * @param $attribute
     */
    public function validateItnCode($attribute)
    {
        if (!$this->hasErrors()) {

            if (!$this->validate10chars($this->itnCode) && !$this->validate12chars($this->itnCode)) {
                $this->addError($attribute, 'Введеный код не является ИНН.');
            }
        }
    }

    /**
     * Validation 10 chars Itn Code
     *
     * @param $validated_itn
     * @return bool
     */
    protected function validate10chars($validated_itn)
    {
        if (preg_match('#([\d]{10})#', $validated_itn, $m)) {
            $inn = $m[0];
            $code10 = (($inn[0] * 2 + $inn[1] * 4 + $inn[2] *10 + $inn[3] * 3 +
                        $inn[4] * 5 + $inn[5] * 9 + $inn[6] * 4 + $inn[7] * 6 +
                        $inn[8] * 8) % 11 ) % 10;
            if ($code10 == $inn[9]) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    /**
     * Validation 12 chars Itn Code
     * @param $validated_itn
     * @return bool
     */
    protected function validate12chars($validated_itn)
    {
        if (preg_match('#([\d]{12})#', $validated_itn, $m)) {
            $inn = $m[0];
            $code11 = (($inn[0] * 7 + $inn[1] * 2 + $inn[2] * 4 + $inn[3] *10 +
                        $inn[4] * 3 + $inn[5] * 5 + $inn[6] * 9 + $inn[7] * 4 +
                        $inn[8] * 6 + $inn[9] * 8) % 11 ) % 10;
            $code12 = (($inn[0] * 3 + $inn[1] * 7 + $inn[2] * 2 + $inn[3] * 4 +
                        $inn[4] *10 + $inn[5] * 3 + $inn[6] * 5 + $inn[7] * 9 +
                        $inn[8] * 4 + $inn[9] * 6 + $inn[10]* 8) % 11 ) % 10;

            if ($code11 == $inn[10] && $code12 == $inn[11]) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }


}
