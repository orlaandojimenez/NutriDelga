<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%historial_clinico}}".
 *
 * @property integer $id
 * @property integer $id_paciente
 * @property integer $id_datos_bioquimicos
 * @property integer $id_datos_dieteticos
 * @property integer $id_intervencion
 * @property integer $id_sintomas
 * @property integer $id_estilo_vida
 * @property integer $id_datos_antropometricos
 * @property integer $id_menu
 * @property string $fecha
 * @property integer $dieta_kcal
 *
 * @property DatosAntropometricos $idDatosAntropometricos
 * @property DatosBioquimicos $idDatosBioquimicos
 * @property DatosDieteticos $idDatosDieteticos
 * @property EstiloVida $idEstiloVida
 * @property Intervencion $idIntervencion
 * @property Menu $idMenu
 * @property Paciente $idPaciente
 * @property SintomasSignos $idSintomas
 */
class HistorialClinico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%historial_clinico}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_paciente', 'id_datos_bioquimicos', 'id_datos_dieteticos', 'id_intervencion', 'id_sintomas', 'id_estilo_vida', 'id_datos_antropometricos', 'id_menu', 'fecha', 'dieta_kcal'], 'required'],
            [['id_paciente', 'id_datos_bioquimicos', 'id_datos_dieteticos', 'id_intervencion', 'id_sintomas', 'id_estilo_vida', 'id_datos_antropometricos', 'id_menu', 'dieta_kcal'], 'integer'],
            [['fecha'], 'safe'],
            [['id_datos_antropometricos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosAntropometricos::className(), 'targetAttribute' => ['id_datos_antropometricos' => 'id']],
            [['id_datos_bioquimicos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosBioquimicos::className(), 'targetAttribute' => ['id_datos_bioquimicos' => 'id']],
            [['id_datos_dieteticos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosDieteticos::className(), 'targetAttribute' => ['id_datos_dieteticos' => 'id']],
            [['id_estilo_vida'], 'exist', 'skipOnError' => true, 'targetClass' => EstiloVida::className(), 'targetAttribute' => ['id_estilo_vida' => 'id']],
            [['id_intervencion'], 'exist', 'skipOnError' => true, 'targetClass' => Intervencion::className(), 'targetAttribute' => ['id_intervencion' => 'id']],
            [['id_menu'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['id_menu' => 'id']],
            [['id_paciente'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::className(), 'targetAttribute' => ['id_paciente' => 'id']],
            [['id_sintomas'], 'exist', 'skipOnError' => true, 'targetClass' => SintomasSignos::className(), 'targetAttribute' => ['id_sintomas' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_paciente' => 'Id Paciente',
            'id_datos_bioquimicos' => 'Id Datos Bioquimicos',
            'id_datos_dieteticos' => 'Id Datos Dieteticos',
            'id_intervencion' => 'Id Intervencion',
            'id_sintomas' => 'Id Sintomas',
            'id_estilo_vida' => 'Id Estilo Vida',
            'id_datos_antropometricos' => 'Id Datos Antropometricos',
            'id_menu' => 'Id Menu',
            'fecha' => 'Fecha',
            'dieta_kcal' => 'Dieta Kcal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosAntropometricos()
    {
        return $this->hasOne(DatosAntropometricos::className(), ['id' => 'id_datos_antropometricos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosBioquimicos()
    {
        return $this->hasOne(DatosBioquimicos::className(), ['id' => 'id_datos_bioquimicos']);
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
    public function getIdEstiloVida()
    {
        return $this->hasOne(EstiloVida::className(), ['id' => 'id_estilo_vida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdIntervencion()
    {
        return $this->hasOne(Intervencion::className(), ['id' => 'id_intervencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'id_menu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPaciente()
    {
        return $this->hasOne(Paciente::className(), ['id' => 'id_paciente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSintomas()
    {
        return $this->hasOne(SintomasSignos::className(), ['id' => 'id_sintomas']);
    }
}
