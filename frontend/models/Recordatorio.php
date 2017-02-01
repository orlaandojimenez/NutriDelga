<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%recordatorio}}".
 *
 * @property integer $id
 * @property string $indicaciones
 * @property integer $kcal
 * @property integer $kcal_desayuno
 * @property integer $kcal_colacion_desayuno
 * @property integer $kcal_comida
 * @property integer $kcal_colacion_comida
 * @property integer $kcal_cena
 * @property integer $kcal_otros
 * @property string $observaciones
 * @property Cantidades[] $cantidades
 * @property Consulta[] $consultas
 */
class Recordatorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recordatorio}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['indicaciones'], 'required'],
            [['observaciones'], 'string', 'max'=>1000],
            [['indicaciones'], 'string'],
            [['kcal', 'kcal_desayuno', 'kcal_colacion_desayuno', 'kcal_comida', 'kcal_colacion_comida', 'kcal_cena', 'kcal_otros'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'indicaciones' => 'Indicaciones',
            'kcal' => 'Kcal',
            'kcal_desayuno' => 'Kcal Desayuno',
            'kcal_colacion_desayuno' => 'Kcal Colacion Desayuno',
            'kcal_comida' => 'Kcal Comida',
            'kcal_colacion_comida' => 'Kcal Colacion Comida',
            'kcal_cena' => 'Kcal Cena',
            'kcal_otros' => 'Kcal Otros',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCantidades()
    {
        return $this->hasMany(Cantidades::className(), ['id_recordatorio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_recordatorio' => 'id']);
    }
}
