<?php

namespace humhub\modules\album;

use Yii;
use humhub\modules\album\models\Album;
use humhub\modules\content\components\ContentContainerModule;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\user\models\User;

class Module extends ContentContainerModule
{
    
    public function __construct($id, $parent = null, $config = array()) {
        parent::__construct($id, $parent, $config);
        if (Yii::$app->user->isGuest) {
            return;
        }
    }
    
    /**
     * Add Album menu on profile.
     * @param yii\base\Event $event
     */
    public function onProfileMenuInit($event) {
        $user = Yii::$app->user->getIdentity();
        if ($user->isModuleEnabled('album')) {
            $event->sender->addItem([
                'label' => 'Album',
                'url' => $event->sender->user->createUrl('//album'),
                'isActive' => Yii::$app->controller->module && Yii::$app->controller->module->id == 'album',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getContentContainerTypes() {
        return [
            User::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function disable() {
        foreach (Album::find()->all() as $album) {
            $album->delete();
        }
        parent::disable();
    }
    
    /**
     * @inheritdoc
     */
    public function disableContentContainer(ContentContainerActiveRecord $container) {
        parent::disableContentContainer($container);
        if ($container instanceof User) {
            foreach (Album::find()->contentContainer($container)->all() as $content) {
               $content->delete();
           }
        }
    }
    
    public function getContentContainerDescription(ContentContainerActiveRecord $container) {
        if ($container instanceof User) {
            return 'Upload your selfies and show your talent to the world.';
        }
    }

}
