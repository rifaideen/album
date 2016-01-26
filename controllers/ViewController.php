<?php

namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use yii\web\NotFoundHttpException;

/**
 * View Album in a nice layout.
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class ViewController extends BaseController {

    public $defaultAction = 'view';

    /**
     * View Album.
     */
    public function actionView($id) {
        $this->subLayout = "@humhub/modules/album/views/_layout";
        return $this->render('/album/view', [
                    'model' => $this->findModel($id),
                    'user' => $this->getUser()
        ]);
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     */
    protected function findModel($id) {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
