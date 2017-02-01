<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use frontend\models\Paciente;
use frontend\models\PacienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Command;

/**
 * PacienteController implements the CRUD actions for Paciente model.
 */
class PacienteController extends Controller
{
    public $layout = 'main';
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
     * Lists all Paciente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PacienteSearch();
        $params = Yii::$app->request->queryParams;
        $params["PacienteSearch"]['id_nutriologo'] = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paciente model.
     * @param integer $id identificador del paciente
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Paciente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paciente();
        $hasUpdated = false;
        if(Yii::$app->request->post("Paciente",$model) != null && isset(Yii::$app->request->post("Paciente")['id']) && Yii::$app->request->post("Paciente")['id'] != 0 ){
            $model = $this->findModel(Yii::$app->request->post("Paciente")['id']);
            $hasUpdated = true;
        }
        if ($model->load(Yii::$app->request->post()) && ($model->id_nutriologo = Yii::$app->user->identity->id)>0 && $model->save()) {
            Yii::$app->session->setFlash('success', '<i class="icon fa fa-check"></i> Paciente '.($hasUpdated? 'actualizado':'creado').' correctamente.');
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $this->renderPartial('_modal_tabs_create',[
                    'model' => $model,
                ],false,true);
            }else{
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_tabs_create',[
                    'model' => $model,
                ],false,true);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Paciente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id identificador del paciente
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<i class="icon fa fa-check"></i> Paciente actualizado correctamente.');
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_tabs_create',[
                        'model' => $model,
                ]); 
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_tabs_create',[
                        'model' => $model,
                ]); 
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Paciente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id identificado del paciente
     * @return mixed
     */
    public function actionDelete($id)
    {//desactivo las llaves foraneas, elimino el registro, y luego las vuelvo a activar.        
        $db = Yii::$app->db;
        $db->createCommand('set FOREIGN_KEY_CHECKS = 0;')->execute();
        $this->findModel($id)->delete();
        $db->createCommand('set FOREIGN_KEY_CHECKS = 1;')->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paciente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paciente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paciente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
