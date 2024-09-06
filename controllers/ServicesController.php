<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Class ServicesController
 * @package app\controllers
 */
class ServicesController extends Controller
{
    public $layout = 'services-all';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionCourts()
    {
        return $this->render('courts');
    }

    /**
     * @return string
     */
    public function actionAjaxCourts()
    {
        $this->layout = false;
        $request      = htmlspecialchars($_GET['request']);
        $request      = explode(' ', $request);

        $result = \app\models\db\CourtsAddresses::find()
            ->where([
                'like',
                'region',
                $request,
            ])
            ->orWhere([
                'like',
                'district',
                $request,
            ])
            ->orWhere([
                'like',
                'city',
                $request,
            ])
            ->orWhere([
                'like',
                'name',
                $request,
            ])
            ->orWhere([
                'like',
                'address',
                $request,
            ])
            ->limit(25)
            ->asArray()
            ->all();

        $html = '';

        foreach ($result as $court) {
            $html .= "{$court['region']} {$court['district']} {$court['city']} {$court['name']} {$court['address']}<br><hr>";
        }

        return $html;
    }

    public function actionOpis()
    {
        return $this->render('opis');
    }

    public function actionOpisResult()
    {
        $this->layout = false;
        $data = $_GET;

        return $this->render('opis-result', [
            'data' => $data,
        ]);
    }
}