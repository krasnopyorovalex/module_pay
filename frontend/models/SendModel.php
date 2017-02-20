<?php

namespace frontend\models;

use Yii;

class SendModel
{

    const THEME = 'Заявка на бронирование с сайта';

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function send($email)
    {

        return Yii::$app->mailer->compose('booking', ['model' => $this->data])
            ->setFrom(['bron@resorts-email.ru' => $this->data['name']])
            ->setTo(explode(',', $email))
            ->setSubject(self::THEME)
            ->send();
    }

}