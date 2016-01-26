<?php
/* @var $this yii\web\View */
/* @var $model humhub\modules\album\models\Album */

use yii\helpers\Html;
use humhub\widgets\GridView;
use yii\helpers\Url;

$baseUrl = humhub\modules\album\Assets::register($this)->baseUrl;
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
<div class="panel" style="border: 2px solid #7191A8;">
    <div class="panel-heading">Album Details</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img class="img-thumbnail" src="<?php echo $model->cover != null ? $model->cover->getPreviewImageUrl(240,320) : $model->getRandomCoverImage($baseUrl); ?>">
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
            'summary'=>'Displaying {begin}-{end} of {count} images.',
            'options' => [
                'class' => 'grid',
            ],
            'tableOptions' => [
                'class' => 'table table-striped table-hover',
            ],
            'columns' => [
                [
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->image->previewImageUrl,array("class"=>"img-thumbnail", "alt" => "loading"));
                    }
                ],
                'name',
                'description',
                [
                    'header' => 'Actions',
                    'class' => 'yii\grid\ActionColumn',
                    'options' => ['width' => '150px'],
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function($url, $data) use($user) {
                            $options = [
                                'title' => 'Update'
                            ];
                            return Html::a('<i class="fa fa-pencil"></i>', Url::to(['update', 'id' => $data->id, 'username' => $user->username]), $options);
                        },
                        'delete' => function($url, $albumImage) use($model) {
                            $options = [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0'
                            ];
                            return Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::to(['details/delete-image', 'id' => $albumImage->id, 'username' => $model->content->user->username]), $options);
                        }
                    ],
                ]
            ]
        ]);
        ?>  
    </div>