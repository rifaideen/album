<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use yii\web\NotFoundHttpException;

class ViewController extends BaseController
{
    public $defaultAction = 'view';
    
    /**
     * Displays a single Album model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->subLayout = "@humhub/modules/album/views/_layout";
        return $this->render('/album/view', [
            'model' => $this->findModel($id),
            'user' => $this->getUser()
        ]);
    }
    
    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
