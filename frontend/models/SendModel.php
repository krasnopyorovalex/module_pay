<?php
/**
 * Created by PhpStorm.
 * User: sanek
 * Date: 22.05.16
 * Time: 23:11
 */

namespace frontend\models;

use Yii;

class SendModel
{
    /**
     * @param $form
     * @param $text
     * @return bool
     */
    public function send($form, $text)
    {
        return Yii::$app->mailer->compose()
            ->setFrom(['sanya-sliver@ya.ru' => $form['name']])
            ->setTo(explode(',', $form['email']))
            ->setHtmlBody($text['text_email'])
            ->setSubject($form['theme'])
            ->send();
    }

}