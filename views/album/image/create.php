<?php
/* @var $this yii\web\View */
/* @var $model Album */

use yii\helpers\Url;

$this->params = [
    [
      'label' => 'Album Details',
      'url' => Url::to(['/album/details','id'=>$album->id, 'username' => $user->username])
    ],
    [
      'label' => 'Add Image',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'View Album',
      'url' => Url::to(['/album/view','id'=>$album->id, 'username' => $user->username])
    ],
    [
      'label' => 'List Album',
      'url' => $user->createUrl('/album')
    ],
    [
      'label' => 'Create Album',
      'url' => Url::to(['/album/create', 'username' => $user->username])
    ],
    [
      'label' => 'Manage Albums',
      'url' => Url::to(['/album/admin','username' => $user->username])
    ]
];
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= $model->isNewRecord ? 'Add Album <strong>Image</strong>': 'Update <strong>Image</strong> Details' ?></div>
    <div class="panel-body">
        <?php echo $this->render('_form', ['model'=>$model]); ?>
    </div>
</div>