<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%datos_dieteticos}}".
 *
 * @property integer $id
 * @property integer $numero_comidas
 * @property string $preaparacion
 * @property string $ganancia
 * @property string $lacteos
 * @property string $frutas
 * @property string $verduras
 * @property string $leguminosas
 * @property string $cereales
 * @property string $aoa
 * @property string $producto
 *
 * @property HistorialClinico[] $historialClinicos
 * @property Paciente[] $pacientes
 */
class DatosDieteticos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%datos_dieteticos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_comidas', 'preaparacion', 'ganancia', 'lacteos', 'frutas', 'verduras', 'leguminosas', 'cereales', 'aoa', 'producto'], 'required'],
            [['numero_comidas'], 'integer'],
            [['preaparacion'], 'string', 'max' => 250],
            [['ganancia', 'lacteos'], 'string', 'max' => 20],
            [['frutas', 'verduras', 'leguminosas', 'cereales', 'aoa', 'producto'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero_comidas' => '#Comidas p/día',
            'preaparacion' => 'Preparación, lugar y compañia',
            'ganancia' => 'Ganacia/Pérdida de peso reciente',
            'lacteos' => 'Lácteos',
            'frutas' => 'Frutas',
            'verduras' => 'Verduras',
            'leguminosas' => 'Leguminosas',
            'cereales' => 'Cereales',
            'aoa' => 'AOA',
            'producto' => 'Producto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_datos_dieteticos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_datos_dieteticos' => 'id']);
    }
}
