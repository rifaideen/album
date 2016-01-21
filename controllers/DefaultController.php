<?php

namespace humhub\modules\album\controllers;

use humhub\modules\content\components\ContentContainerController;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * Description of DefaultController
 *
 * @author Administrator
 */
class DefaultController extends ContentContainerController
{

    public $subLayout = "@humhub/modules/album/views/_layout";
    
    public $menu = [];

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /*
        $user = $this->getUser();
        $criteria = new Query();
        $criteria->from = 'Album';
        $criteria->where = 't.created_by = :creater';
        $criteria->params = [':creater' => $user->id];
        $dataProvider = new ActiveDataProvider([
            'query' => $criteria,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        $this->render('/album/index', [
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
         * 
         */
    }

}
