<?php

namespace humhub\modules\album\controllers;

use humhub\modules\album\models\Album;

/**
 * Show Album Entry on wall.
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class WallEntryController extends BaseController
{

    public $defaultAction = 'view';

    /**
     * View Album on wall.
     */
    public function actionView($id) {
        return $this->renderAjax('/album/ajaxView', [
                    'model' => Album::findOne($id)
        ]);
    }

}
