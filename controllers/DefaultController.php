<?php

namespace humhub\modules\album\controllers;

use humhub\modules\album\models\Album;
use yii\data\ActiveDataProvider;

/**
 * Description of DefaultController
 *
 * @author Administrator
 */
class DefaultController extends BaseController
{

    /**
     * Lists all models.
     */
    public function actionIndex() {
        
        $user = $this->getUser();

        $criteria = Album::find();
        $criteria->from = ['album_album t'];
        $criteria->where = 't.created_by = :creater';
        $criteria->params = [':creater' => $user->id];
        $criteria->with = ['cover'];
        $dataProvider = new ActiveDataProvider([
            'query' => $criteria,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        return $this->render('/album/index', [
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
        
    }
    
    public function actionCreate()
    {
        return 'Hi';
    }

}
