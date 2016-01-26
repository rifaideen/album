<?php

use yii\widgets\ActiveForm;
use humhub\compat\CHtml;
use humhub\modules\file\widgets\FileUploadButton;
use humhub\modules\file\widgets\FileUploadList;
use humhub\modules\album\models\Album;

$uguid = $user->guid;
$username = $user->username;

$this->params = [
    [
      'label' => 'Album Details',
      'url' => ['/album/details','id'=>$model->id,'username'=>$username]
    ],
    [
      'label' => 'Add Image',
      'url' => ['/album/create/image','id'=>$model->id,'username'=>$username]
    ],
    [
      'label' => 'View Album',
      'url' => ['/album/view','id'=>$model->id,'username'=>$username]
    ],
    [
      'label' => 'Update Album',
      'url' => ['/album/update','id'=>$model->id,'username'=>$username]
    ],
    [
      'label' => 'Update Album Cover',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'List Album',
      'url' => ['/album','uguid'=>$uguid]
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create','username'=>$username]
    ],
    [
      'label' => 'Manage Albums',
      'url' => ['/album/admin','username'=>$username]
    ]
];
?>

<div class="panel panel-default">
    <div class="panel-heading">Update Album <strong>Cover</strong></div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
                'id'=>'album-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>true,
        ]); ?>
        
            <?php echo $form->errorSummary($model,null,null,['class'=>'errorMessage']); ?>


            <div class="form-group">
                <label>Album Cover</label><br/>
                <?php 
                    echo FileUploadButton::widget([
                        'fileListFieldName' => 'Album[image]',
                        'object' => new Album,
                        //'uploadTo' => '//album/image/upload',
                        'uploaderId' => 'cover_uploader'
                    ]); 
                
                    echo FileUploadList::widget([
                        'uploaderId' => 'cover_uploader'
                    ]);
                ?>
                <?php echo CHtml::error($model,'image'); ?>
            </div>

            <hr>

            <?php echo CHtml::submitButton('Update Cover',['class'=>'btn btn-primary']); ?>
            <?php echo CHtml::a('Back to Album Details', ['/album/details','id'=>$model->id,'username'=>$user->username], ['class'=>'btn btn-info']); ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>