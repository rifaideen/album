<?php

use yii\helpers\Html;

echo "<strong>".Html::encode($originator->displayName)."</strong> created a new album ";

echo ' "' . \humhub\widgets\RichText::widget(['text' => $source->name, 'minimal' => true, 'maxLength' => 100]) . '"';
?>