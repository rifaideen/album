<?php

use yii\widgets\ActiveForm;
use humhub\compat\CHtml;
use humhub\modules\file\widgets\FileUploadButton;
use humhub\modules\file\widgets\FileUploadList;
?>

<div class="form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'album-image-form',
        'enableAjaxValidation' => false,
    ]);
    ?>

    <p class="hint">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model, null, null, ['class' => 'errorMessage']); ?>

    <?php if ($model->isNewRecord): ?>
        <div class="form-group">
            <label><b>Image *</b></label><br/>
            <?php
            echo FileUploadButton::widget([
                'fileListFieldName' => 'AlbumImage[_image]',
                'object' => $model,
                'uploaderId' => 'image_uploader'
            ]);

            echo FileUploadList::widget([
                'uploaderId' => 'image_uploader'
            ]);
            ?>
        </div>
    <?php endif; ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => 100]); ?>

    <?php echo $form->field($model, 'description')->textInput(['maxlength' => 255]); ?>



    <hr>

    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add to Album' : 'Update Image Details', ['class' => 'btn btn-primary']); ?>

    <?php ActiveForm::end(); ?>

</div>