<?php

use humhub\modules\user\widgets\ProfileMenu;

return [
    'id' => 'album',
    'class' => 'humhub\modules\album\Module',
    'namespace' => 'humhub\modules\album',
    'events' => [
        [
            'class'=> ProfileMenu::className(),
            'event' => ProfileMenu::EVENT_INIT,
            'callback' => ['humhub\modules\album\Module', 'onProfileMenuInit']
        ]
    ]
];