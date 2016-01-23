<?php

namespace humhub\modules\album;

use Yii;
use humhub\modules\album\models\Album;

class Module extends \humhub\components\Module
{
    
    public function onProfileMenuInit($event)
    {
        $event->sender->addItem([
            'label' => 'Album',
            'url' => $event->sender->user->createUrl('//album'),//, array('username' => $event->sender->user->username,'uguid' => $event->sender->user->guid)),
            'isActive' => Yii::$app->controller->module && Yii::$app->controller->module->id == 'album',
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function getContentContainerTypes()
    {
        return [
            User::className()
        ];
    }
    
    public function disable() {
        
        foreach (Album::find()->all() as $album) {
            $album->delete();
        }
        
        parent::disable();
        
    }
}
