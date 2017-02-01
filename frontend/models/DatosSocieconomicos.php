<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%datos_socieconomicos}}".
 *
 * @property integer $id
 * @property string $ocupacion
 * @property string $horario
 * @property integer $dinero_comida
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Paciente[] $pacientes
 */
class DatosSocieconomicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%datos_socieconomicos}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ocupacion', 'horario', 'dinero_comida'], 'required'],
            [['dinero_comida', 'created_at', 'updated_at'], 'integer'],
            [['ocupacion', 'horario'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ocupacion' => 'Ocupación',
            'horario' => 'Horario',
            'dinero_comida' => 'Destinado a alimentos al mes',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_datos_socieconomicos' => 'id']);
    }
}
