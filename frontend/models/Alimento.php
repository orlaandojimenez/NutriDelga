<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%alimento}}".
 *
 * @property integer $id
 * @property integer $id_nutriologo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $kcal
 * @property integer $por_lipidos
 * @property integer $por_proteinas
 * @property integer $por_carbohidratos
 * @property string $rico_en
 * @property string $racion
 * @property integer $tipo
 * @property integer $adicional
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Nutriologo $idNutriologo
 * @property PlatilloAlimento[] $platilloAlimentos
 */
class Alimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%alimento}}';
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
            [['id_nutriologo', 'kcal', 'por_lipidos', 'por_proteinas', 'por_carbohidratos', 'tipo', 'created_at', 'updated_at'], 'number'],
            [['nombre', 'kcal', 'por_lipidos', 'por_proteinas', 'por_carbohidratos', 'rico_en', 'racion'], 'required'],
            [['racion', 'unidad'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 200],
            [['rico_en'], 'string', 'max' => 500],
            [['id_nutriologo'], 'exist', 'skipOnError' => true, 'targetClass' => Nutriologo::className(), 'targetAttribute' => ['id_nutriologo' => 'id']],
            [['adicional'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nutriologo' => 'Id Nutriologo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'kcal' => 'kcal',
            'por_lipidos' => 'g. Lipidos',
            'por_proteinas' => 'g. Proteinas',
            'por_carbohidratos' => 'g. Carbohidratos',
            'rico_en' => 'Rico En',
            'racion' => 'Racion',
            'unidad' => 'Unidad',
            'tipo' => 'Tipo',
            'adicional' => 'Adicional',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNutriologo()
    {
        return $this->hasOne(Nutriologo::className(), ['id' => 'id_nutriologo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlatilloAlimentos()
    {
        return $this->hasMany(PlatilloAlimento::className(), ['id_alimento' => 'id']);
    }
}
