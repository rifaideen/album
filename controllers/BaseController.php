<?php

namespace humhub\modules\album\controllers;

use humhub\modules\content\components\ContentContainerController;

class BaseController  extends ContentContainerController
{
    public $subLayout = "@humhub/modules/album/views/_layout";
    public $menu = [];
}
