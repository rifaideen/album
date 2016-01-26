<?php

namespace humhub\modules\album\controllers;

use humhub\modules\album\models\Album;
use yii\data\ActiveDataProvider;

/**
 * List Albums in user profile created by the profile owner.
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class DefaultController extends BaseController
{

    /**
     * Lists all Albums.
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
                'pageSize' => 10
            ]
        ]);
        return $this->render('/album/index', [
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
        
    }
}
