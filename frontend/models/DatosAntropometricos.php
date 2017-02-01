<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%datos_antropometricos}}".
 *
 * @property integer $id
 * @property integer $peso
 * @property integer $talla
 * @property integer $imc
 * @property integer $porciento_grasa
 * @property integer $porciento_agua
 * @property integer $grasa_visceral
 * @property integer $masa_magra
 * @property integer $edad_metabolica
 * @property integer $cintura
 * @property integer $cadera
 * @property integer $abdomen
 * @property string $pb
 * @property integer $peso_objetivo
 * @property string $observaciones
 * @property Consulta[] $consultas
 * @property HistorialClinico[] $historialClinicos
 */
class DatosAntropometricos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%datos_antropometricos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peso', 'talla', 'imc', 'porciento_grasa','porciento_agua', 'grasa_visceral', 'masa_magra', 'edad_metabolica', 'cintura', 'cadera', 'abdomen', 'pb', 'peso_objetivo'], 'required'],
            [['observaciones'], 'string', 'max' => 1000],
            [['peso', 'talla', 'imc', 'porciento_grasa', 'porciento_agua', 'grasa_visceral', 'masa_magra', 'edad_metabolica', 'cintura', 'cadera', 'abdomen', 'peso_objetivo'], 'integer'],
            [['pb'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'peso' => 'Peso',
            'talla' => 'Talla',
            'imc' => 'IMC',
            'porciento_grasa' => '% Grasa',
            'porciento_agua' => '% Agua',
            'grasa_visceral' => 'Grasa Visceral',
            'masa_magra' => 'Masa Magra',
            'edad_metabolica' => 'Edad Metabolica',
            'cintura' => 'C.Cin',
            'cadera' => 'C.Cad',
            'abdomen' => 'C.Abd',
            'pb' => 'PB',
            'peso_objetivo' => 'Peso Objetivo',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_datos_antropometricos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_datos_antropometricos' => 'id']);
    }
}
