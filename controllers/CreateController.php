<?php

namespace humhub\modules\album\controllers;

use Yii;
use humhub\modules\album\models\Album;
use humhub\modules\album\models\AlbumImage;
use humhub\modules\file\models\File;
use yii\web\NotFoundHttpException;

/**
 * Description of CreateController
 *
 * @author Administrator
 */
class CreateController extends BaseController
{

    public $defaultAction = 'create';
    
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->subLayout = "@humhub/modules/album/views/_layout";
        return true;
    }

        /**
     * Creates a new album with optional album cover.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $user = $this->getUser();
        
        if ($user->id != Yii::$app->user->id) {
            throw new NotFoundHttpException('You can create album only on your profile.', 403);
        }
        $this->subLayout = "@humhub/modules/album/views/_layout";
        $model = new Album;
        
        if(isset($_POST['Album']))
        {
            $model->content->container = $user;
            $model->attributes=$_POST['Album'];
            if ($model->save()) {
                File::attachPrecreated($model, $_POST['cover']);
                return $this->redirect(['/album/view','id'=>$model->id,'username'=>$user->username]);
            }
        }
        return $this->render('/album/create',[
                    'model'=>$model,
                    'user'=>$user
        ]);
    }
    
        public function actionImage($id)
	{
            $album = Album::findOne($id);
            $user = $this->getUser();
            
            if ($album === null) {
                throw new NotFoundHttpException('The requested album does not exists.', 404);
            }
            
            $model=new AlbumImage;
            $model->scenario = 'insert';
            
            if(isset($_POST['AlbumImage']))
            {
                    $model->attributes=$_POST['AlbumImage'];
                    $model->album_id = $album->id;
                    if($model->save()) {
                        File::attachPrecreated($model, $model->_image);
                        return $this->redirect(['/album/view','id'=>$album->id, 'username' => $user->username]);
                    }
            }
            return $this->render('/album/image/create',[
                'model'=>$model,
                'album'=>$album,
                'user'=>$user
            ]);
	}

}
