<?php

namespace humhub\modules\album\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord as ActiveRecord;

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
class Album extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $wallEntryClass = "humhub\modules\album\widgets\WallEntry";
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
    
    
    public function getContentName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(AlbumImage::className(), ['album_id' => 'id']);
    }

    public function getCover()
    {
        return $this->hasOne(\humhub\modules\file\models\File::className(), ['object_id' => 'id'])->onCondition(['object_model' => self::className()]);
    }
    
    public function getRandomCoverImage($baseUrl)
    {
        return $baseUrl . '/img/'.  rand(1, 16) . '.jpg';
    }
}