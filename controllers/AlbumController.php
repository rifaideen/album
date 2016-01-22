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
class AlbumController extends ContentContainerController
{

    public $subLayout = "@humhub/modules/album/views/_layout";
    
    public $menu = [];

    /**
     * Lists all models.
     */
    public function actionIndex() {
        
        return 'Hello';
        
    }
    
    public function actionCreate()
    {
        return 'Hi';
    }

}
