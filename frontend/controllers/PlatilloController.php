<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use frontend\models\Platillo;
use frontend\models\PlatilloSearch;
use frontend\models\PlatilloAlimento;
use frontend\models\Alimento;
use frontend\models\AlimentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PlatilloController implements the CRUD actions for Platillo model.
 */
class PlatilloController extends Controller
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
     * Lists all Platillo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlatilloSearch();
        $dataProvider = $searchModel->search(["PlatilloSearch"=>['id_nutriologo'=>Yii::$app->user->identity->id]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Platillo model.
     * @param integer $id identify
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Platillo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Platillo();
        $platilloAlimentos = [];

        $request = Yii::$app->request->post();
        $isValid = true;

        if($ingredientes = Yii::$app->request->post('PlatilloAlimento')){
            for ($i=0; $i < count($ingredientes); $i++) { 
                $platilloAlimentos[$i] = new PlatilloAlimento();
                $platilloAlimentos[$i]->load(['PlatilloAlimento'=>$ingredientes[$i]]);
                $isValid = $platilloAlimentos[$i]->validate() && $isValid;
            }
        }else{
            $isValid = false;
        }
        $model->id_nutriologo = Yii::$app->user->identity->id;
        if($model->load($request) && $isValid && Yii::$app->request->isPost && $model->validate() && $model->save()){
            foreach ($platilloAlimentos as $key => $modelPlatilloAlimento) {
                $modelPlatilloAlimento->id_platillo = $model->id;
                $modelPlatilloAlimento->save();
            }
            if(Yii::$app->request->isAjax){
                
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if(Yii::$app->request->isAjax){
            return $this->renderPartial('_modal_create', [
                'model' => $model,
                'ingredientes' => $platilloAlimentos,
                'dataProviderAlimentos' => $this->getAlimentos(),
            ]);
        }
        return $this->render('create', [
            'model' => $model,
            'ingredientes' => $platilloAlimentos,
            'dataProviderAlimentos' => $this->getAlimentos(),
        ]);
        
    }

    /**
     * Updates an existing Platillo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id identify
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isGet)
            $platilloAlimentos = $model->platilloAlimentos;// == null ? [] : $model->platilloAlimentos;
        else
            $platilloAlimentos = [];

        $request = Yii::$app->request->post();
        $isValid = true;

        if($ingredientes = Yii::$app->request->post('PlatilloAlimento')){
            for ($i=0; $i < count($ingredientes); $i++) { 
                $platilloAlimentos[$i] = new PlatilloAlimento();
                $platilloAlimentos[$i]->load(['PlatilloAlimento'=>$ingredientes[$i]]);
                $isValid = $platilloAlimentos[$i]->validate() && $isValid;
            }
        }else{
            $isValid = false;
        }
        $platilloAlimentosBorrar = $model->platilloAlimentos;
        if($model->load($request) && $isValid && Yii::$app->request->isPost && $model->validate() && $model->save()){
            foreach ($platilloAlimentos as $key => $modelPlatilloAlimento) {
                $modelPlatilloAlimento->id_platillo = $model->id;
                $modelPlatilloAlimento->save();
            }
            foreach ($platilloAlimentosBorrar as $key => $value) {
                $value->delete();
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        }        
        return $this->render('update', [
            'model' => $model,
            'ingredientes' => $platilloAlimentos,
            'dataProviderAlimentos' => $this->getAlimentos(),
        ]);
    }

    /**
     * Deletes an existing Platillo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id identify
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
     * Finds the Platillo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id identify
     * @return Platillo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $submodel = Alimento::findOne($id);
        if (($model = Platillo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds all Alimentos
     * @return AlimentoSearch the loaded models
     */
    protected function getAlimentos(){
        $searchModel = new AlimentoSearch();
        $dataProvider = $searchModel->search([
            'AlimentoSearch'=>[
                'id_nutriologo'=>Yii::$app->user->identity->id
            ]
        ]);
        return $dataProvider;
    }
}
