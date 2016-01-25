<?php
/* @var $this AlbumController */
/* @var $dataProvider CActiveDataProvider */
use yii\widgets\ListView;
use yii\helpers\Url;
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4">
                <h3 class="panel-title">
                    <i class="fa fa-image"></i> Albums
                </h3>
            </div>
            <?php if ($user->id == Yii::$app->user->id): ?>
            <div class="col-md-3  col-md-offset-1">
                <a href="<?= Url::to(['/album/create', 'username' => $user->username]) ?>" class="btn btn-info">
                    <i class="fa fa-plus"></i> Create Album
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?= Url::to(['/album/admin', 'username' => $user->username]) ?>" class="btn btn-warning">
                    <i class="fa fa-chevron-right"></i> Manage Albums
                </a>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
                'viewParams' => [
                    'user' => $user
                ],
                'summary' => false,
                'emptyText' => '&nbsp;&nbsp;&nbsp;No albums found.',
                'pager' => [
                    'maxButtonCount' => 5,
                    'nextPageLabel' => '<i class="fa fa-step-forward"></i>',
                    'prevPageLabel' => '<i class="fa fa-step-backward"></i>',
                    'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
                    'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
                    'options' => array('class' => 'pagination pull-right', 'style' => 'margin-right:10px;')
                ],
                'layout' => "{summary}\n{items}\n<div class='clearfix'></div><div class='pagination-container'>{pager}</div>"
            ]);
            ?>
        </div>
    </div>
</div>