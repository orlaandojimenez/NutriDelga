<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use frontend\models\DownloadHistorial;

class DownloadController extends \yii\web\Controller
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
        ];
    }

    /**
     * Download historial of paciente
     * @param integer $id identify
     * @return mixed
     */
    public function actionHistorial($id){
        $model = new DownloadHistorial();
        $model->fecha_ini = date('Y/m/d', $this->getMaxMinCreatedAtConsulta($id,false));
        $model->fecha_fin = date('Y/m/d', $this->getMaxMinCreatedAtConsulta($id,true));
        if(Yii::$app->request->isAjax && Yii::$app->request->isGet){
            return $this->renderAjax('_modal_download_historial',[
                'model'=>$model
            ]);
        }
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            $paciente = $this->findModelPaciente($id);
            $historial = $this->getHistorial($id, $model->fecha_ini, $model->fecha_fin);
            // get your HTML raw content without any layouts or scripts
            $content = $this->renderPartial('historial',['consultas'=>$historial]);
         
            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                //'mode' => Pdf::MODE_CORE, 
                'format' => Pdf::FORMAT_A4, 
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                'destination' => Pdf::DEST_BROWSER, 
                'content' => $content,  
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                'cssInline' => '.kv-heading-1{font-size:18px}', 
                'options' => ['title' => "Historial | $paciente->nombres $paciente->apellidos"],
                'methods' => [ 
                    'SetHeader'=>["GRAYAP | Historial | $paciente->nombres $paciente->apellidos"], 
                    'SetFooter'=>['{PAGENO}'],
                ]
            ]);
         
            // return the pdf output as per the destination setting
            return $pdf->render(); 
        }else{
            return $this->render('_modal_download_historial',[
                'model'=>$model
            ]);   
        }
    }

    /**
     * Download dieta in pdf format
     * @param integer $id identify
     * @return mixed
     */
    public function actionDieta($id){

        $consulta = $this->findModelConsulta($id);
        $paciente = $consulta->idPaciente;
        $dietas = $consulta->dietas;
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('dieta',[
            'paciente' => $paciente,
            'dietas' => $dietas,
            'consulta' => $consulta,
        ]);
     
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            //'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'options' => ['title' => "Dieta | $paciente->nombres $paciente->apellidos"],
            'methods' => [ 
                'SetHeader'=>["GRAYAP | Dieta | $paciente->nombres $paciente->apellidos"], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
         
            // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    /**
     * Download consulta
     * @param integer $id identify
     * @return mixed
     */
    public function actionConsulta($id){
        $consulta = $this->findModelConsulta($id);

        $paciente = $consulta->idPaciente;
        $antropometricos = $consulta->idDatosAntropometricos;
        $bioquimicos = $consulta->idDatosBioquimicos;
        $estilovida = $consulta->idEstiloVida;
        $intervencion = $consulta->idIntervencion;
        $recordatorio = $consulta->idRecordatorio;
        $sintomassignos = $consulta->idSintomasSignos;
        $cantidades = $recordatorio !== null ? $recordatorio->cantidades : null;
        $dietas = $consulta->dietas;

        $platillos = $this->getPlatillos(Yii::$app->user->identity->id);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('consulta',[
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
     
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            //'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'options' => ['title' => "Consulta | $paciente->nombres $paciente->apellidos"],
            'methods' => [ 
                'SetHeader'=>["GRAYAP | Consulta | $paciente->nombres $paciente->apellidos"], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
     
        // return the pdf output as per the destination setting
        return $pdf->render(); 
        //return $content;
    }

    /**
     * Consulting max or min created a consulta
     * @param integer $id identify
     * @param boolean $max
     * @return boolean
     */
    public function getMaxMinCreatedAtConsulta($id, $max = true){
        $query = \frontend\models\Consulta::find()
            ->where(["id_paciente"=>$id]);
        return $max ? $query->max('created_at') : $query->min('created_at');
    }

    /**
     * Find model of paciente
     * @param integer $id
     * @return Paciente
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModelPaciente($id)
    {
        if (($model = \frontend\models\Paciente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException("No existe un paciente con ese identificador [$id]. ");
        }
    }

    /**
     * Find model of consulta
     * @param integer $id identify
     * @return Consulta
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModelConsulta($id)
    {
        if (($model = \frontend\models\Consulta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException("No existe consulta con ese identificador [$id]. ");
        }
    }

    /**
     * Find historial of consultas
     * @param integer $id identify
     * @return Consulta[]
     */
    protected function getHistorial($id, $fechaInicio, $fechaFin){        
        $query = \frontend\models\Consulta::find()
            ->where(["id_paciente"=>$id])
            ->andWhere([">=","created_at",strtotime($fechaInicio)])
            ->andWhere(["<=","created_at",strtotime($fechaFin)]);
        return $query->all();
    }

    /**
     * Find all platillos
     * @param integer $id identify
     * @return \yii\data\ActiveDataProvider
     */
    protected function getPlatillos($id){
        $query = \frontend\models\Platillo::find()->where(["id_nutriologo"=>$id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=> $query,
        ]);
        return $dataProvider;
    }

}
