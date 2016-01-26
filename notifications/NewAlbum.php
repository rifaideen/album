<?php

namespace humhub\modules\album\notifications;

use humhub\modules\user\models\User;

/**
 * Notification for new albums.
 * 
 * @author Rifaudeen <rifajas@gmail.com>
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
}
