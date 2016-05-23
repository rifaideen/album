<?php

use yii\helpers\Html;

echo "<strong>".Html::encode($originator->displayName)."</strong> created a new album ";
?>
<br />

<em>"<?= \humhub\widgets\RichText::widget(['text' => $source->name, 'minimal' => true]); ?>"</em>