<?php

namespace humhub\modules\album\controllers;

use humhub\modules\content\components\ContentContainerController;

/**
 * BaseController defines the properties and methods used often in the controller.
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class BaseController  extends ContentContainerController
{
    /**
     * Sublayout
     */
    public $subLayout = "@humhub/modules/album/views/_layout";
    
    /**
     * Sidebar Menu
     */
    public $menu = [];
}
