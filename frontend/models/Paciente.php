<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%paciente}}".
 *
 * @property integer $id
 * @property integer $id_nutriologo
 * @property integer $id_datos_socieconomicos
 * @property integer $id_datos_clinicos
 * @property integer $id_datos_dieteticos
 * @property string $nombres
 * @property string $apellidos
 * @property integer $sexo
 * @property string $telefono
 * @property string $motivo
 * @property string $email
 * @property string $fecha_nacimiento
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Consulta[] $consultas
 * @property HistorialClinico[] $historialClinicos
 * @property DatosClinicos $idDatosClinicos
 * @property DatosDieteticos $idDatosDieteticos
 * @property DatosSocieconomicos $idDatosSocieconomicos
 * @property Nutriologo $idNutriologo
 */
class Paciente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%paciente}}';
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
            [['id_nutriologo', 'id_datos_socieconomicos', 'id_datos_clinicos', 'id_datos_dieteticos', 'sexo', 'status', 'created_at', 'updated_at'], 'integer'],
            [['nombres', 'apellidos', 'sexo', 'telefono', 'motivo', 'email', 'fecha_nacimiento'], 'required'],
            [['motivo'], 'string'],
            [['fecha_nacimiento'], 'safe'],
            [['nombres', 'apellidos', 'email'], 'string', 'max' => 50],
            [['telefono'], 'string', 'max' => 15],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['id_datos_clinicos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosClinicos::className(), 'targetAttribute' => ['id_datos_clinicos' => 'id']],
            [['id_datos_dieteticos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosDieteticos::className(), 'targetAttribute' => ['id_datos_dieteticos' => 'id']],
            [['id_datos_socieconomicos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosSocieconomicos::className(), 'targetAttribute' => ['id_datos_socieconomicos' => 'id']],
            [['id_nutriologo'], 'exist', 'skipOnError' => true, 'targetClass' => Nutriologo::className(), 'targetAttribute' => ['id_nutriologo' => 'id']],
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
            'id_datos_socieconomicos' => 'Id Datos Socieconomicos',
            'id_datos_clinicos' => 'Id Datos Clinicos',
            'id_datos_dieteticos' => 'Id Datos Dieteticos',
            'nombres' => 'Nombre',
            'apellidos' => 'Apellidos',
            'sexo' => 'Sexo',
            'telefono' => 'Telefono',
            'motivo' => 'Motivo',
            'email' => 'Correo',
            'fecha_nacimiento' => 'Fecha de nacimiento',
            'status' => 'Estatus',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_paciente' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_paciente' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosClinicos()
    {
        return $this->hasOne(DatosClinicos::className(), ['id' => 'id_datos_clinicos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosDieteticos()
    {
        return $this->hasOne(DatosDieteticos::className(), ['id' => 'id_datos_dieteticos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosSocieconomicos()
    {
        return $this->hasOne(DatosSocieconomicos::className(), ['id' => 'id_datos_socieconomicos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNutriologo()
    {
        return $this->hasOne(Nutriologo::className(), ['id' => 'id_nutriologo']);
    }
}
