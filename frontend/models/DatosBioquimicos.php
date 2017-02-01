<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%datos_bioquimicos}}".
 *
 * @property integer $id
 * @property string $reciente
 *
 * @property Consulta[] $consultas
 * @property HistorialClinico[] $historialClinicos
 */
class DatosBioquimicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%datos_bioquimicos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reciente'], 'required'],
            [['reciente'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reciente' => 'Reciente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_datos_bioquimicos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_datos_bioquimicos' => 'id']);
    }
}
