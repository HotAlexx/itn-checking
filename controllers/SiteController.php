<?php

namespace app\controllers;

use app\models\ItnForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $model = new ItnForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $status = $this->checkStatus($model->itnCode);
            if ($status === null) {
                $message = "Установить статус не удалось.";
            } else {
                if ($status === true) {
                    $message = "Данный нальгоплательщик является плательщиком налога на профессиональный доход";
                } else {
                    $message = "Данный нальгоплательщик НЕ является плательщиком налога на профессиональный доход";
                }
            }
            Yii::$app->session->setFlash('success', "Код успешно отправлен на проверку! Результат проверки: " . $message);
//
//            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    protected function checkStatus($inn)
    {
        $date = new \DateTime('NOW');
        $fns_data = Yii::$app->fnsapi->checkSelfemployed($inn, $date);

        if (isset($fns_data['status'])) {
            return $fns_data['status'];
        } else {
            return null;
        }

    }

}
