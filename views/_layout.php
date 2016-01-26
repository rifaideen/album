<?php
/* @view $this yii\web\View */
use yii\widgets\Menu;

$user = Yii::$app->user->getIdentity();
$username = explode('/', Yii::$app->request->pathInfo, 2);
?>

<div class="container">
    <div class="row">
        <?php if ($user->isModuleEnabled($this->context->module->id) && $user->username == $username[0]): ?>
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">Albums Menu</div>
                <div class="panel-body">
                    <?php
                    echo Menu::widget([
                        'items'=>$this->params,
                        'options'=>[
                            'class'=>'nav nav-pills nav-stacked'
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
        <?php else: ?>
        <?php $this->beginContent('@humhub/modules/user/views/profile/_layout.php', ['user'=>$user]); ?>
            <div class="col-md-12">
                <?php echo $content; ?>
            </div>
        <?php $this->endContent(); ?>
        <?php endif; ?>
    </div>
</div>