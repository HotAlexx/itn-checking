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

        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    protected function checkStatus($inn)
    {
        $saved_status = Yii::$app->cache->get('status_' . $inn);
        if ($saved_status === false) {
            $date = new \DateTime('NOW');
            $fns_data = Yii::$app->fnsapi->checkSelfemployed($inn, $date);

            if (isset($fns_data['status'])) {
                $status = $fns_data['status'];

                if ($status) {
                    Yii::$app->cache->set('status_' . $inn, ItnForm::SELF_EMPLOYED);
                } else {
                    Yii::$app->cache->set('status_' . $inn, ItnForm::NOT_SELF_EMPLOYED);
                }
            } else {
                $status = null;
            }
        } else {
            if ($saved_status == ItnForm::SELF_EMPLOYED) {
                $status = true;
            } else {
                $status = false;
            }

        }
        return $status;
    }

}
