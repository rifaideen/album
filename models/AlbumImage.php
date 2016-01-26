<?php

namespace humhub\modules\album\models;

use Yii;
use humhub\modules\file\models\File;

/**
 * Album Image holds info about individual album images.
 * 
 * @author Rifaudeen <rifajas@gmail.com>
 */

/**
 * This is the model class for table "album_image".
 *
 * @property integer $id
 * @property integer $album_id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Album $album
 */
class AlbumImage extends \yii\db\ActiveRecord
{

    /**
     * holds uploaded file name during album creation.
     */
    public $_image;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'album_image';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['album_id', 'name', 'description'], 'required'],
            [['_image'], 'required', 'on' => 'insert'],
            [['album_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'album_id' => 'Album ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Get Associated Album
     */
    public function getAlbum() {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

    /**
     * Get Uploaded Image
     */
    public function getImage() {
        return $this->hasOne(\humhub\modules\file\models\File::className(), ['object_id' => 'id'])->onCondition(['object_model' => self::className()]);
    }

    /**
     * Delete Album Image
     */
    public function beforeDelete() {
        if ($this->image instanceof File) {
            $this->image->delete();
        }
        return parent::beforeDelete();
    }
}
