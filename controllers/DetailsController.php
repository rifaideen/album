<?php

namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use humhub\modules\album\models\AlbumImage;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class DetailsController extends BaseController
{
    
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->subLayout = "@humhub/modules/album/views/_layout";
        return true;
    }
    
    public function actionIndex($id)
    {
        $model = Album::findOne(['id'=>$id,'created_by'=>Yii::$app->user->id]);

        if ($model === null) {
            throw new NotFoundHttpException('The requested album does not exists.', 404);
        }
        
        $criteria = AlbumImage::find();
        $criteria->where = 'album_id = '.$model->id;
        $criteria->with = ['image'];
        $dataProvider = new ActiveDataProvider([
            'query' => $criteria,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);

        return $this->render('/album/details',[
            'model' => $model,
            'dataProvider' => $dataProvider,
            'user' => Yii::$app->user->getIdentity()
        ]);
    }

}
