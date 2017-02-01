<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%estilo_vida}}".
 *
 * @property integer $id
 * @property integer $sueno
 * @property integer $actividad_fisica
 * @property string $tipo_actividad_fisica
 * @property string $frecuencia_actividad_fisica
 * @property string $duracion_actividad_fisica
 * @property integer $fuma
 * @property string $cantidad_fuma
 * @property integer $alcohol
 * @property string $cantidad_alcohol
 * @property integer $suplementos
 * @property string $cantidad_suplementos
 * @property string $observaciones
 * @property Consulta[] $consultas
 * @property HistorialClinico[] $historialClinicos
 */
class EstiloVida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%estilo_vida}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sueno', 'actividad_fisica', 'fuma', 'alcohol', 'suplementos','duracion_actividad_fisica'], 'required'],
            [['observaciones'], 'string', 'max' => 1000],
            [['sueno', 'actividad_fisica', 'fuma', 'alcohol', 'suplementos','duracion_actividad_fisica'], 'integer'],
            [['tipo_actividad_fisica', 'frecuencia_actividad_fisica', 'cantidad_fuma', 'cantidad_alcohol', 'cantidad_suplementos'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sueno' => 'Sueño',
            'actividad_fisica' => 'Actividad física',
            'tipo_actividad_fisica' => 'Tipo Actividad Fisica',
            'frecuencia_actividad_fisica' => 'Frecuencia Actividad Fisica',
            'duracion_actividad_fisica' => 'Duración',
            'fuma' => 'Fuma',
            'cantidad_fuma' => 'Cantidad Fuma',
            'alcohol' => 'Alcohol',
            'cantidad_alcohol' => 'Cantidad de alcohol',
            'suplementos' => 'Suplementos',
            'cantidad_suplementos' => 'Cantidad Suplementos',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_estilo_vida' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_estilo_vida' => 'id']);
    }
}
