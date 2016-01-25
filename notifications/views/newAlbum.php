<?php

use yii\helpers\Html;

$album = $source->content->getPolymorphicRelation();
?>
<?php
echo "<strong>". Html::encode($source->content->user->displayName) ."</strong> created ".$this->context->getContentInfo($album).".";
?>
<em>"<?php echo humhub\widgets\RichText::widget(['text' => $source->name, 'minimal' => true, 'maxLength' => 400]); ?>"</em>