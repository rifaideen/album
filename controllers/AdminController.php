<?php

namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use humhub\modules\album\models\AlbumImage;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

/**
 * Manage Album in GridView
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class AdminController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->subLayout = "@humhub/modules/album/views/_layout";
        return true;
    }

    /**
     * List Albums in GridView
     */
    public function actionIndex() {
        $criteria = Album::find();
        $criteria->where = ['created_by' => Yii::$app->user->id];
        $dataProvider = new ActiveDataProvider([
            'query' => $criteria,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('/album/admin', [
                    'dataProvider' => $dataProvider,
                    'user' => Yii::$app->user->getIdentity()
        ]);
    }

    /**
     * Delete Album.
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/album/admin', 'username' => $_GET['username']]);
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     */
    protected function findModel($id) {
        
        if (($model = Album::findOne(['id' => $id, 'created_by' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
