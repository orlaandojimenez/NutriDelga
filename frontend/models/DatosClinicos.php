<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%datos_clinicos}}".
 *
 * @property integer $id
 * @property string $antecedentes_familiares
 * @property string $antecedentes_personales
 * @property string $padecimiento_actual
 * @property string $medicamentos
 *
 * @property Paciente[] $pacientes
 */
class DatosClinicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%datos_clinicos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['antecedentes_familiares', 'antecedentes_personales', 'padecimiento_actual', 'medicamentos'], 'required'],
            [['antecedentes_familiares', 'antecedentes_personales', 'padecimiento_actual', 'medicamentos'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'antecedentes_familiares' => 'Antecedentes Familiares',
            'antecedentes_personales' => 'Antecedentes Personales',
            'padecimiento_actual' => 'Padecimiento Actual',
            'medicamentos' => 'Medicamentos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_datos_clinicos' => 'id']);
    }
}
