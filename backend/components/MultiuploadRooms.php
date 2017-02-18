<?php

namespace backend\components;

use common\models\RoomsImages;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;

class MultiuploadRooms extends Action
{
    const DELIMITER = '/';
    public function run()
    {
        $room_id = Yii::$app->request->post('room_id');
        $path = Yii::getAlias('@frontend'.RoomsImages::PATH . $room_id . self::DELIMITER);
        if (!file_exists($path)) FileHelper::createDirectory($path, 755, true);

        $image = new RoomsImages;
        $image->file = UploadedFile::getInstancesByName('file');
        //save to DB
        $image['room_id'] = $room_id;
        $image['basename'] = md5(Yii::$app->getSecurity()->generateRandomString(25));
        $image['ext'] = $image->file[0]->extension;
        $image['publish'] = 1;

        if($image->validate()){
            $image->file[0]->saveAs($path . $image['basename'] . '.' . $image['ext']);
            //thumb
            Image::thumbnail($path . $image['basename'] . '.' . $image['ext'], 250, 170)
                ->save($path . $image['basename'] . '_250_170.' . $image['ext'], ['quality' => 100]);
            return $image->save();
        }
    }
} 