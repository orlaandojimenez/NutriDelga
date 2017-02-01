<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%intervencion}}".
 *
 * @property integer $id
 * @property integer $kcal
 * @property integer $porcentaje_carbohidratos
 * @property integer $porcentaje_lipidos
 * @property integer $porcentaje_proteina
 * @property string $indicaciones
 * @property integer $gramos_carbohidratos
 * @property integer $gramos_lipidos
 * @property integer $gramos_proteina
 * @property string $observaciones
 * @property Consulta[] $consultas
 * @property HistorialClinico[] $historialClinicos
 */
class Intervencion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%intervencion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kcal', 'porcentaje_carbohidratos', 'porcentaje_lipidos', 'porcentaje_proteina', 'indicaciones', 'gramos_carbohidratos', 'gramos_lipidos', 'gramos_proteina'], 'required'],
            [['observaciones'], 'string','max' => 1000],
            [['kcal', 'porcentaje_carbohidratos', 'porcentaje_lipidos', 'porcentaje_proteina', 'gramos_carbohidratos', 'gramos_lipidos', 'gramos_proteina'], 'integer'],
            [['indicaciones'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kcal' => 'Kcal',
            'porcentaje_carbohidratos' => '% CH',
            'porcentaje_lipidos' => '% LP',
            'porcentaje_proteina' => '% PT',
            'indicaciones' => 'Indicaciones',
            'gramos_carbohidratos' => 'g. Carbohidratos',
            'gramos_lipidos' => 'g. Lipidos',
            'gramos_proteina' => 'g. Proteina',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_intervencion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_intervencion' => 'id']);
    }
}
