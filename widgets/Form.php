<?php

namespace humhub\modules\album\widgets;

use humhub\modules\comment\widgets\Form as CommentForm;
use Yii;

/**
 * Comment Form
 * 
 * @author Rifaudeen<rifajas@gmail.com>
 */
class Form extends CommentForm
{

    public static $autoIdPrefix = 'album_';

    /**
     * Executes the widget.
     */
    public function run()
    {

        if (Yii::$app->user->isGuest)
            return "";

        $modelName = $this->object->content->object_model;
        $modelId = $this->object->content->object_id;
        $id = $modelName . "_" . $modelId;

        return $this->render('form', array(
                    'modelName' => $modelName,
                    'modelId' => $modelId,
                    'id' => self::$autoIdPrefix .  $this->object->getUniqueId(),
        ));
    }

}

?>