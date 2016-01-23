<?php
/* @var $this yii\web\View */
/* @var $model Album */

$this->params = [
    [
      'label' => 'List Album',
      'url' => $user->createUrl('/album')
    ],
    [
      'label' => 'Create Album',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Manage Albums',
      'url' => $user->createUrl('/album/admin')
    ],
];
?>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Create</strong> Album</div>
    <div class="panel-body">
        <?php echo $this->render('/album/_form', ['model'=>$model]); ?>
    </div>
</div>