<?php

use yii\helpers\Html;
use humhub\widgets\GridView;
use yii\helpers\Url;

$uguid = $user->guid;
$username = $user->username;

$this->params = [
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
      'url' => '#',
      'active' => true
    ],
];
?>

<div class="panel panel-default">
    <div class="panel-heading"><strong>Manage</strong> Albums</div>
    <div class="panel-body">
        <?php echo GridView::widget([
            'id'=>'album-grid',
            'tableOptions' => [
                'class' => 'table table-hover table-striped'
            ],
            'summary'=>'Displaying {begin}-{end} of {count} albums.',
            'dataProvider' => $dataProvider,
            'columns'=>[
                'id',
                'name',
                'description',
                [
                    'header' => 'Created',
                    'value' => function($data){ return humhub\widgets\TimeAgo::widget(['timestamp' => $data->created_at]);},
                    'format'=>'html'
                ],
                [
                    'header' => 'Updated',
                    'value' => function($data){ return humhub\widgets\TimeAgo::widget(['timestamp' => $data->updated_at]);},
                    'format'=>'html'
                ],
                [
                    'header' => 'Actions',
                    'class' => 'yii\grid\ActionColumn',
                    'options' => ['width' => '150px'],
                    'template' => '{view} {update} {delete} {details}',
                    'buttons' => [
                    	'view' => function($url, $data) use($user) {
                            $options = [
                                'title' => 'View'
                            ];
                            return Html::a('<i class="fa fa-eye"></i>', Url::to(['/album/view', 'id' => $data->id, 'username' => $user->username]), $options);
                        },
                        'update' => function($url, $data) use($user) {
                            $options = [
                                'title' => 'Update'
                            ];
                            return Html::a('<i class="fa fa-pencil"></i>', Url::to(['/album/update', 'id' => $data->id, 'username' => $user->username]), $options);
                        },
                        'delete' => function($url, $data) use($user) {
                            $options = [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0'
                            ];
                            return Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::to(['delete', 'id' => $data->id, 'username' => $user->username]), $options);
                        },
                        'details' => function($url, $data) use($user) {
                        	$options = [
                            'label' => '<i class="fa fa-bars"></i>',
                            'title' => 'Details'
                        	];
                        	return Html::a('<i class="fa fa-bars"></i>', Url::to(["/album/details","id"=>$data->id, 'username' => $user->username]), $options);
                    	}
                    ],
                ],
                
            ],
        ]); 
        ?>
    </div>
</div>