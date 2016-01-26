<?php

namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use humhub\modules\album\models\AlbumImage;
use humhub\modules\file\models\File;
use yii\web\NotFoundHttpException;

/**
 * Update Album Details and Album Cover.
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class UpdateController extends BaseController
{

    public $defaultAction = 'update';

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->subLayout = "@humhub/modules/album/views/_layout";
        return true;
    }

    /**
     * Update Album
     */
    public function actionUpdate($id) {
        $user = $this->getUser();

        if ($user->id != Yii::$app->user->id) {
            throw new NotFoundHttpException('You can create album only on your profile.', 403);
        }
        
        $this->subLayout = "@humhub/modules/album/views/_layout";
        $model = $this->findModel($id);

        if ($model->created_by !== $user->id) {
            throw new NotFoundHttpException('You have insufficient permission', 301);
        }

        if (isset($_POST['Album'])) {
            $model->attributes = $_POST['Album'];
            if ($model->save()) {
                return $this->redirect(['/album/view', 'id' => $model->id, 'username' => $user->username]);
            }
        }
        return $this->render('/album/create', [
            'model' => $model,
            'user' => $user
        ]);
    }

    /**
     * Update Album Cover
     */
    public function actionCover($id) {
        $model = $this->findModel($id);
        $model->scenario = 'update-cover';
        $user = $this->getUser();
        if ($model->created_by !== $user->id) {
            throw new NotFoundHttpException('You have insufficient permission', 301);
        }

        if (isset($_POST['Album'])) {
            $model->attributes = $_POST['Album'];
            if ($model->validate('image')) {
                if ($model->cover instanceof File) {
                    $model->cover->delete();
                }
                File::attachPrecreated($model, $model->image);
                $this->redirect(['/album/view', 'id' => $model->id, 'username' => $user->username]);
            }
        }

        return $this->render('/album/cover', compact('model', 'user'));
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
