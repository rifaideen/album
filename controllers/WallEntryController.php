<?php

namespace humhub\modules\album\controllers;

use humhub\modules\album\models\Album;

class WallEntryController extends BaseController
{
    public $defaultAction = 'view';
    
    public function actionView($id)
    {
        return $this->renderAjax('/album/ajaxView',[
            'model'=> Album::findOne($id)
        ]);
    }
}
