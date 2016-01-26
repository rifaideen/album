<?php

namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use humhub\modules\album\models\AlbumImage;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

/**
 * View Album Details in GridView
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class DetailsController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete-image' => ['post'],
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
     * List Album Details in GridView
     */
    public function actionIndex($id) {
        $model = Album::findOne(['id' => $id, 'created_by' => Yii::$app->user->id]);

        if ($model === null) {
            throw new NotFoundHttpException('The requested album does not exists or you don\'t have permission to view this album.', 404);
        }

        $criteria = AlbumImage::find();
        $criteria->where = 'album_id = ' . $model->id;
        $criteria->with = ['image'];
        $dataProvider = new ActiveDataProvider([
            'query' => $criteria,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('/album/details', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'user' => Yii::$app->user->getIdentity()
        ]);
    }

    /**
     * Update Album Image name and description.
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $user = Yii::$app->user->getIdentity();

        if (isset($_POST['AlbumImage'])) {
            $model->attributes = $_POST['AlbumImage'];
            $model->album_id = $model->album->id;
            if ($model->save()) {
                return $this->redirect(['/album/view', 'id' => $model->album->id, 'username' => $user->username]);
            }
        }
        return $this->render('/album/image/create', [
            'model' => $model,
            'album' => $model->album,
            'user' => $user
        ]);
    }

    /**
     * Deletes an existing AlbumImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteImage($id) {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/album/details', 'id' => $model->album_id, 'username' => $_GET['username']]);
    }

    /**
     * Finds the AlbumImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     */
    protected function findModel($id) {
        $model = AlbumImage::find()->joinWith(['album' => function($query) {
            $query->onCondition(['created_by' => Yii::$app->user->id]);
        }], true, 'RIGHT JOIN')->where([AlbumImage::tableName() . '.id' => $id])->one();

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}