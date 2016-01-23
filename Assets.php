<?php

namespace humhub\modules\album;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    public $css = [
        'css/normalize.css',
        'css/demo.css',
        'css/component.css'
    ];
    
    public $js = [
        'js/modernizr.min.js',
        'js/classie.js',
        'js/photostack.js'
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];


    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . '/assets';
        parent::init();
    }
}