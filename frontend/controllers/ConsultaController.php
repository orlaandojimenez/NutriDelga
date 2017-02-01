<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use frontend\models\Consulta;
use frontend\models\Platillo;
use frontend\models\Dieta;
use frontend\models\DatosAntropometricos;
use frontend\models\DatosBioquimicos;
use frontend\models\EstiloVida;
use frontend\models\Intervencion;
use frontend\models\Recordatorio;
use frontend\models\SintomasSignos;
use frontend\models\Cantidades;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ConsultaController extends \yii\web\Controller
{

	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [                        
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Render historial clinico
     * @param integer $id
     * @return mixed
     */
    public function actionHistorial($id){
        $paciente = $this->findModelPaciente($id);

        return $this->render('historial',[
            'model' => $this->getHistorial($id),
            'paciente' => $paciente,
        ]);
    }

    /**
     * Create a new consulta
     * @param integer $id
     */
    public function actionCreate($id)
    {
        $paciente = $this->findModelPaciente($id);
        $consulta = new Consulta();
        $consulta->id_paciente = $paciente->id;

        if($consulta->validate() && $consulta->save()){
            return $this->redirect(['assing', 'id'=>$consulta->id]);
        }else{
            throw new NotFoundHttpException('Error al crear la consulta.');
        }
    }

    /**
     * Render graph of paciente
     * @param integer $id
     * @return mixed
     */
    public function actionGrafica($id){
        $paciente = $this->findModelPaciente($id);


        if(Yii::$app->request->isAjax){
            return $this->renderPartial('_modal_grafica',[
                'model'=>$paciente
            ]);
        }else{
            return $this->render(['grafica']);
        }
    }

    /**
     * Create new consulta for Paciente
     * @param integer $id
     * @return mixed
     */
    public function actionAssing($id){
        $consulta = $this->findModelConsulta($id);
        
        $paciente = $consulta->idPaciente;
        $antropometricos = $consulta->idDatosAntropometricos === null ? new DatosAntropometricos() : $consulta->idDatosAntropometricos;
        $bioquimicos = $consulta->idDatosBioquimicos === null ? new DatosBioquimicos() : $consulta->idDatosBioquimicos;
        $estilovida = $consulta->idEstiloVida === null ? new EstiloVida() : $consulta->idEstiloVida;
        $intervencion = $consulta->idIntervencion === null ? new Intervencion() : $consulta->idIntervencion;
        $recordatorio = $consulta->idRecordatorio === null ? new Recordatorio() : $consulta->idRecordatorio;
        //$recordatorios = $consulta->recordatorios === null ? new Recordatorios() : $consulta->recordatorios;
        $sintomassignos = $consulta->idSintomasSignos === null ? new SintomasSignos() : $consulta->idSintomasSignos;
        $cantidades = $recordatorio->cantidades === null ? [] : $recordatorio->cantidades;
        $dietas = $consulta->dietas === null ? [] : $consulta->dietas;
        $platillos = $this->getPlatillos(Yii::$app->user->identity->id);

        $isValidCantidades = true;
        $isValidDietas = true;

        $recordatorio->kcal=0;
        $recordatorio->kcal_desayuno=0;
        $recordatorio->kcal_colacion_desayuno=0;
        $recordatorio->kcal_comida=0;
        $recordatorio->kcal_colacion_comida=0;
        $recordatorio->kcal_cena=0;
        $recordatorio->kcal_otros=0;

        if($dietasArray = Yii::$app->request->post("Dieta")){
            for ($i=0; $i < count($dietasArray); $i++) { 
                $dietas[$i] = new Dieta();
                $dietas[$i]->load(['Dieta'=>$dietasArray[$i]]);
                $isValidDietas = $dietas[$i]->validate() && $isValidDietas;
            }
        }

        if($cantidadesPost = Yii::$app->request->post("Cantidades")){
            for ($i=0; $i < count($cantidadesPost); $i++) { 
                $cantidades[$i] = new Cantidades();
                $cantidades[$i]->tipo = $i;
                $cantidades[$i]->load(['Cantidades'=>$cantidadesPost[$i]]);
                $isValidCantidades = $cantidades[$i]->validate() && $isValidCantidades;
                $recordatorio->kcal_desayuno += $cantidades[$i]->desayuno * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_colacion_desayuno += $cantidades[$i]->colacion_desayuno * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_comida += $cantidades[$i]->comida * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_colacion_comida += $cantidades[$i]->colacion_comida * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_cena += $cantidades[$i]->cena * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_otros += $cantidades[$i]->otros * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
            }
            $recordatorio->kcal += $recordatorio->kcal_desayuno + $recordatorio->kcal_colacion_desayuno + $recordatorio->kcal_comida + $recordatorio->kcal_colacion_comida + $recordatorio->kcal_cena + $recordatorio->kcal_otros;
        }else if(count($cantidades) == 0){
            for ($i=0; $i < count(Yii::$app->params['tipoCantidadEnum']); $i++) { 
                $cantidades[$i] = new Cantidades();
                $cantidades[$i]->tipo = $i;
                $cantidades[$i]->desayuno = 0;
                $cantidades[$i]->colacion_desayuno = 0;
                $cantidades[$i]->comida = 0;
                $cantidades[$i]->colacion_comida = 0;
                $cantidades[$i]->cena = 0;
                $cantidades[$i]->otros = 0;
                $recordatorio->kcal_desayuno += $cantidades[$i]->desayuno * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_colacion_desayuno += $cantidades[$i]->colacion_desayuno * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_comida += $cantidades[$i]->comida * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_colacion_comida += $cantidades[$i]->colacion_comida * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_cena += $cantidades[$i]->cena * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
                $recordatorio->kcal_otros += $cantidades[$i]->otros * Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][1];
            }
            $recordatorio->kcal += $recordatorio->kcal_desayuno + $recordatorio->kcal_colacion_desayuno + $recordatorio->kcal_comida + $recordatorio->kcal_colacion_comida + $recordatorio->kcal_cena + $recordatorio->kcal_otros;
        }else{
            foreach ($cantidades as $key => $cantidad) {
                $recordatorio->kcal_desayuno += $cantidad->desayuno * Yii::$app->params['tipoCantidadEnum'][$cantidad->tipo][1];
                $recordatorio->kcal_colacion_desayuno += $cantidad->colacion_desayuno * Yii::$app->params['tipoCantidadEnum'][$cantidad->tipo][1];
                $recordatorio->kcal_comida += $cantidad->comida * Yii::$app->params['tipoCantidadEnum'][$cantidad->tipo][1];
                $recordatorio->kcal_colacion_comida += $cantidad->colacion_comida * Yii::$app->params['tipoCantidadEnum'][$cantidad->tipo][1];
                $recordatorio->kcal_cena += $cantidad->cena * Yii::$app->params['tipoCantidadEnum'][$cantidad->tipo][1];
                $recordatorio->kcal_otros += $cantidad->otros * Yii::$app->params['tipoCantidadEnum'][$cantidad->tipo][1];
            }
            $recordatorio->kcal += $recordatorio->kcal_desayuno + $recordatorio->kcal_colacion_desayuno + $recordatorio->kcal_comida + $recordatorio->kcal_colacion_comida + $recordatorio->kcal_cena + $recordatorio->kcal_otros;
        }



        $request = Yii::$app->request;

        $antropometricos->load($request->post());
        $bioquimicos->load($request->post());
        $estilovida->load($request->post());
        $intervencion->load($request->post());
        $sintomassignos->load($request->post());
        $recordatorio->load($request->post());
        
        $cantidadesTemp = $recordatorio->cantidades;
        $dietasTemp = $consulta->dietas;

        if(Yii::$app->request->isAjax){
            $consulta->id_sintomas_signos = $sintomassignos->validate() && $sintomassignos->save() ? $sintomassignos->id : null;
            $consulta->id_datos_antropometricos = $antropometricos->validate() && $antropometricos->save() ? $antropometricos->id : null;
            $consulta->id_datos_bioquimicos = $bioquimicos->validate() && $bioquimicos->save() ? $bioquimicos->id : null;
            $consulta->id_estilo_vida = $estilovida->validate() && $estilovida->save() ? $estilovida->id : null;
            $consulta->id_intervencion = $intervencion->validate() && $intervencion->save() ? $intervencion->id : null;
            $consulta->id_recordatorio = $recordatorio->validate() && $recordatorio->save() ? $recordatorio->id : null;
            if($isValidCantidades && $request->post("Cantidades") !== null  && $recordatorio->id !== null){
                foreach ($cantidades as $key => $value) {
                    $value->id_recordatorio = $recordatorio->id;
                    $value->save();
                }
                foreach ($cantidadesTemp as $key => $value) {
                    $value->delete();
                }
            }
            if($request->post("Dieta") !== null){
                foreach ($dietas as $key => $value) {
                    $value->id_consulta = $consulta->id;
                    $value->save();
                }
                foreach ($dietasTemp as $key => $value) {
                    $value->delete();
                }
            }

            $consulta->save();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $html = null;
            if($request->post("DatosAntropometricos") !== null){
                return [
                    'error'=> $consulta->id_datos_antropometricos === null,
                    'html' => $this->renderPartial('_form_antropometrico',[
                        'model'=>$antropometricos
                    ],false,true),
                ];
            }else if($request->post("DatosBioquimicos") !== null){
                return [
                    'error'=> $consulta->id_datos_bioquimicos === null,
                    'html' => $this->renderPartial('_form_bioquimicos',[
                        'model'=>$bioquimicos
                    ]),
                ];
            }else if($request->post("EstiloVida") !== null){
                return [
                    'error'=> $consulta->id_estilo_vida === null,
                    'html' => $this->renderPartial('_form_estilo',[
                        'model'=>$estilovida
                    ]),
                ];
            }else if($request->post("Intervencion") !== null){
                return [
                    'error'=> $consulta->id_intervencion === null,
                    'html' => $this->renderPartial('_form_intervencion',[
                        'model'=>$intervencion
                    ]),
                ];
            }else if($request->post("SintomasSignos") !== null){
                return [
                    'error'=> $consulta->id_sintomas_signos === null,
                    'html' => $this->renderPartial('_form_signos_sintomas',[
                        'model'=>$sintomassignos
                    ]),
                ];
            }else if($request->post("Cantidades") !== null && $request->post("Recordatorio") !== null){
                return [
                    'error'=> !$isValidCantidades || $consulta->id_recordatorio === null,
                    'html' => $this->renderPartial('_form_recordatorio',[
                        'model'=>$recordatorio,
                        'cantidades'=>$cantidades
                    ]),
                ];
            }else if($request->post("Dieta")){
                return [
                    'error'=> !$isValidDietas,
                    'html' => $this->renderPartial('_form_dieta',[
                        'model'=>$dietas,
                        'platillos' => $platillos
                    ]),
                ];
            }
        }else{
            return $this->render('assing',[
                'consulta' => $consulta,
                'paciente' => $paciente,
                'antropometricos' => $antropometricos,
                'bioquimicos' => $bioquimicos,
                'estilovida' => $estilovida,
                'intervencion' => $intervencion,
                'recordatorios' => $recordatorio,
                'cantidades' => $cantidades,
                'sintomassignos' => $sintomassignos,
                'dietas' => $dietas,
                'platillos' => $platillos
            ]);
        }
    }

    /**
     * Deletes an existing Alimento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {//desactivo las llaves foraneas, elimino el registro, y luego las vuelvo a activar.
        $db = Yii::$app->db;
        $db->createCommand('set FOREIGN_KEY_CHECKS = 0;')->execute();
        $consulta = $this->findModelConsulta($id);
        $id = $consulta->idPaciente->id;
        $consulta->delete();
        $db->createCommand('set FOREIGN_KEY_CHECKS = 1;')->execute();
        return $this->redirect(['historial','id'=>$id]);
    }



    /**
     * Search paciende by id
     * @param integer $id
     * @return \frontend\models\Paciente
     */
    protected function findModelPaciente($id)
    {
        if (($model = \frontend\models\Paciente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("No existe un paciente con ese identificador [$id]. ");
        }
    }

    /**
     * Search consulta by id
     * @param integer $id
     * @return mixed
     */
    protected function findModelConsulta($id)
    {
        if (($model = \frontend\models\Consulta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("No existe consulta con ese identificador [$id]. ");
        }
    }

    /**
     * Find all historial of paciente
     * @param integer $id
     * @return mixed
     */
    protected function getHistorial($id){        
        $query = Consulta::find()->where(["id_paciente"=>$id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    /**
     * Find All platillos model where id_nutriologo = $id
     * @param integer $id
     * @return ActiveDataProvider
     */
    protected function getPlatillos($id){
        $query = Platillo::find()->where(["id_nutriologo"=>$id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=> $query,
        ]);
        return $dataProvider;
    }

}

