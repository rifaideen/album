<?php

use yii\helpers\Html;

$album = $source->content->getPolymorphicRelation();
?>
<?php
echo "<strong>". Html::encode($source->content->user->displayName) ."</strong> created ".$this->context->getContentInfo($album).".";
?>