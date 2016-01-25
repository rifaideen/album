<?php
/* @var $this yii\web\View */
/* @var $model humhub\modules\album\models\Album */

use yii\helpers\Html;
use humhub\widgets\GridView;

$this->registerCss('.grid img {height:120px;width:120px;} .button-column img {height: inherit !important;width: inherit !important;}', [], 'grid-image-fix');

$uguid = $user->guid;
$username = $user->username;

$this->params = [
    [
      'label' => 'Album Details',
      'url' => '#',
      'active' => true
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
      'url' => ['/album/update/cover','id'=>$model->id,'username'=>$username]
    ],
    [
      'label' => 'List Album',
      'url' => ['/album','username'=>$username]
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
<div class="panel" style="border: 2px solid #7191A8;">
    <div class="panel-heading">Album Details</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img class="img-thumbnail" src="<?php echo $model->cover->getPreviewImageUrl(240,320); ?>">
            </div>
            <div class="col-md-9">
                <?php echo Html::a(Html::encode($model->name),['/album/view','id'=>$model->id,'username'=>$username,'uguid'=>$uguid]); ?>
                <hr>
                <?php echo Html::encode($model->description); ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">Images</div>
    <div class="panel-body">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
//            'itemsCssClass' => 'table table-striped',
            'summary'=>'Displaying {begin}-{end} of {count} images.',
            'options' => [
                'class' => 'grid',
            ],
//            'columns' => [
//                [
//                    'type' => 'raw',
//                    'value' => 'CHtml::image($data->image->url,"loading",array("class"=>"img-thumbnail"))',
//                ],
////                'image.url:image:Image',
//                'name',
//                'description',
//                [
//                    'class' => 'CButtonColumn',
//                    'updateButtonUrl' => '["image/update","id"=>$data->id]',
//                    'deleteButtonUrl' => '["image/delete","id"=>$data->id]',
//                    'updateButtonLabel' => '<i class="fa fa-pencil"></i>',
//                    'updateButtonOptions' => [
//                        'title' => 'Update'
//                    ],
//                    'deleteButtonLabel' => '<i class="fa fa-trash"></i>',
//                    'deleteButtonOptions' => [
//                        'title' => 'Delete'
//                    ],
//                    'updateButtonImageUrl' => false,
//                    'deleteButtonImageUrl' => false,
//                    'template' => '{update} {delete}'
//                ]
//            ]
        ]);
        ?>  
    </div>