<?php

namespace app\modules\album\models;

use Yii;

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
 * @property AlbumAlbum $album
 */
class AlbumImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id', 'name', 'description'], 'required'],
            [['album_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(AlbumAlbum::className(), ['id' => 'album_id']);
    }
}
