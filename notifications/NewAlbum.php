<?php

namespace humhub\modules\album\notifications;

use humhub\modules\user\models\User;

/**
 * Notification for new albums
 */
class NewAlbum extends \humhub\modules\notification\components\BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'album';

    /**
     * @inheritdoc
     */
    public $viewName = 'newAlbum';

    /**
     * @inheritdoc
     */
    public function send(User $user)
    {
        // Check there is also an mentioned notifications, so ignore this notification
        /*
          if (Notification::model()->findByAttributes(array('class' => 'MentionedNotification', 'source_object_model' => 'Comment', 'source_object_id' => $comment->id)) !== null) {
          continue;
          }
         */

        return parent::send($user);
    }

}

?>
