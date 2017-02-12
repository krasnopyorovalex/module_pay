<?php

namespace common\models;

use backend\components\MultiuploadRooms;
use Yii;

/**
 * This is the model class for table "rooms_images".
 *
 * @property integer $id
 * @property integer $room_id
 * @property string $name
 * @property string $alt
 * @property string $title
 * @property string $basename
 * @property string $ext
 * @property integer $publish
 * @property integer $pos
 *
 * @property Rooms $room
 */
class RoomsImages extends \yii\db\ActiveRecord
{

    const PATH = '/web/userfiles/rooms_gallery/';

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'publish', 'pos'], 'integer'],
            [['name', 'alt', 'title'], 'string', 'max' => 512],
            [['basename'], 'string', 'max' => 256],
            [['ext'], 'string', 'max' => 5],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'name' => 'Название',
            'alt' => 'Alt',
            'title' => 'Title',
            'basename' => 'Basename',
            'ext' => 'Ext',
            'publish' => 'Publish',
            'pos' => 'Pos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $path = Yii::getAlias('@frontend'.self::PATH . $this->room_id . MultiuploadRooms::DELIMITER);
            unlink($path . $this->basename .'.'. $this->ext);
            unlink($path . $this->basename .'_250_170.'. $this->ext);
            return true;
        } else {
            return false;
        }
    }
}
