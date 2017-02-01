<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%dieta}}".
 *
 * @property integer $id
 * @property integer $id_platillo
 * @property integer $id_consulta
 * @property string $nombre
 * @property integer $tipo
 * @property integer $dia
 * @property string $cantidad_calorica
 *
 * @property Consulta $idConsulta
 * @property Platillo $idPlatillo
 */
class Dieta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dieta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_platillo', 'tipo', 'dia'], 'required'],
            [['id_platillo', 'id_consulta', 'tipo', 'dia'], 'integer'],
            [['cantidad_calorica'], 'number'],
            [['nombre'], 'string', 'max' => 45],
            [['id_consulta'], 'exist', 'skipOnError' => true, 'targetClass' => Consulta::className(), 'targetAttribute' => ['id_consulta' => 'id']],
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
            'id_consulta' => 'Id Consulta',
            'nombre' => 'Nombre',
            'tipo' => 'Tipo',
            'dia' => 'Dia',
            'cantidad_calorica' => 'Cantidad Calorica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConsulta()
    {
        return $this->hasOne(Consulta::className(), ['id' => 'id_consulta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlatillo()
    {
        return $this->hasOne(Platillo::className(), ['id' => 'id_platillo']);
    }
}
