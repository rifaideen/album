<?php
/* @var $this AlbumController */
/* @var $model Album */
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img class="img-rounded" src="<?= $model->coverImage ?>">
        <div class="caption text-center">
            <h3><a href="<?= $this->createUrl('/album/view',['id'=>$model->id,'username'=>$user->username,'uguid'=>$user->guid]) ?>"><?= $model->name ?></a></h3>
        </div>
    </div>
</div>