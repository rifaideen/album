<?php

namespace humhub\modules\album\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord as ActiveRecord;

/**
 * Album model to store basic album details.
 * 
 * @author Rifaudeen <rifajas@gmail.com>
 */

/**
 * This is the model class for table "album_album".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property AlbumImage[] $albumImages
 */
class Album extends ActiveRecord {

    /**
     * used to validate cover image when updating cover.
     */
    public $image;

    /**
     * @inheritdoc
     */
    public $wallEntryClass = "humhub\modules\album\widgets\WallEntry";

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'album_album';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['image'], 'required', 'on' => 'update-cover'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getContentName() {
        return 'Album';
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription() {
        return $this->name;
    }

    /**
     * Get Album Images
     */
    public function getImages() {
        return $this->hasMany(AlbumImage::className(), ['album_id' => 'id']);
    }
    
    /**
     * Get Album Cover file.
     */
    public function getCover() {
        return $this->hasOne(\humhub\modules\file\models\File::className(), ['object_id' => 'id'])->onCondition(['object_model' => self::className()]);
    }

    /**
     * Get Random cover image.
     */
    public function getRandomCoverImage($baseUrl) {
        return $baseUrl . '/img/' . rand(1, 16) . '.jpg';
    }

    /**
     * Send notifiction to user followers
     */
    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            $notification = new \humhub\modules\album\notifications\NewAlbum();
            $notification->source = $this;
            $notification->originator = Yii::$app->user->getIdentity();
            $notification->sendBulk($notification->originator->getFollowers(null, true, true));
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Delete Album images.
     */
    public function beforeDelete() {
        foreach ($this->images as $image) {
            $image->delete();
        }
        return parent::beforeDelete();
    }

}
