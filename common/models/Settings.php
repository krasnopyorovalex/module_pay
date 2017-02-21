<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $sys_name
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_name'], 'required'],
            [['value'], 'string'],
            [['sys_name'], 'string', 'max' => 128],
            [['file'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sys_name' => 'Sys Name',
            'value' => 'Value',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->value = $this->file->baseName . '.' . $this->file->extension;
            $this->save();
            return $this->file->saveAs(Yii::getAlias('@frontend/web/userfiles/').$this->file->baseName . '.' . $this->file->extension);
        } else {
            return false;
        }
    }
}
