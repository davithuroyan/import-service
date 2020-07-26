<?php

namespace app\controllers;

use app\models\ImportTask;
use app\models\ImportTaskForm;
use app\models\Store;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
 /*           'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        $imports = ImportTask::find()
            ->orderBy('id')
            ->all();
        
        return $this->render('index', ['imports' => $imports]);
    }
    
    public function actionAddImportTask()
    {
        $importForm = new ImportTaskForm();
        $importModel = new ImportTask();
        $stores = Store::find()->all();
        
        if (Yii::$app->request->isPost) {
            $importForm->load(Yii::$app->request->post());
            $importForm->file = UploadedFile::getInstance($importForm, 'file');
            
            if ($fileName = $importForm->upload()) {
                $importModel->file = $fileName;
                $importModel->store_id = $importForm->store_id;
                $importModel->status = ImportTask::STATUS_NEW;
                $importModel->save();
                
                Yii::$app->session->setFlash('success', "Import file successfully uploaded.");
                
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error', "Invalid file.");
            }
        }
        
        return $this->render(
            'add-import-task',
            [
                'model' => $importForm,
                'stores' => $stores,
            ]
        );
    }
    
}
