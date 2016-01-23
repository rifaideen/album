<?php

use yii\widgets\ActiveForm;
use humhub\compat\CHtml;
use humhub\modules\file\widgets\FileUploadButton;
use humhub\modules\file\widgets\FileUploadList;
?>

<div class="form">

<?php $form=ActiveForm::begin([
	'id'=>'album-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
]); ?>

	<p class="hint">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,null,null,['class'=>'errorMessage']); ?>

	<?php echo $form->field($model, 'name')->textInput(['maxlength' => 255]); ?>

	<?php echo $form->field($model, 'description')->textArea(['rows'=>6, 'cols'=>50]); ?>
	
        <?php if ($model->isNewRecord): ?>
        <div class="form-group">
                <label>Album Cover</label><br/>
                <?php 
                    echo FileUploadButton::widget([
                        'fileListFieldName' => 'cover',
                        'object' => $model,
                        //'uploadTo' => '//album/image/upload',
                        'uploaderId' => 'cover_uploader'
                    ]); 
                
                    echo FileUploadList::widget([
                        'uploaderId' => 'cover_uploader'
                    ]); 
                ?>
        </div>
        <?php endif; ?>
        
        <hr>
	
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update',['class'=>'btn btn-primary']); ?>

<?php ActiveForm::end(); ?>

</div>