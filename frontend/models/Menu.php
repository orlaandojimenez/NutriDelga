<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $id_platillo
 * @property integer $dia_semana
 * @property integer $cantidad_calorica
 *
 * @property HistorialClinico[] $historialClinicos
 * @property Platillo $idPlatillo
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_platillo', 'dia_semana', 'cantidad_calorica'], 'required'],
            [['id_platillo', 'dia_semana', 'cantidad_calorica'], 'integer'],
            [['id_platillo'], 'exist', 'skipOnError' => true, 'targetClass' => Platillo::className(), 'targetAttribute' => ['id_platillo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_platillo' => 'Id Platillo',
            'dia_semana' => 'Dia Semana',
            'cantidad_calorica' => 'Cantidad Calorica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_menu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlatillo()
    {
        return $this->hasOne(Platillo::className(), ['id' => 'id_platillo']);
    }
}
