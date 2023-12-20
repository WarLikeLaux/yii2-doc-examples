<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    const SCENARIO_GUEST = 'guest';
    const SCENARIO_USER = 'user';


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['!name', 'email', 'subject', 'body'], 'required', 'on' => self::SCENARIO_GUEST],
            [['!name', 'subject', 'body'], 'required', 'on' => self::SCENARIO_USER],
            ['email', 'email', 'on' => self::SCENARIO_GUEST],
            ['verifyCode', 'captcha', 'on' => [self::SCENARIO_GUEST, self::SCENARIO_USER]]
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        switch ($this->scenario) {
            case self::SCENARIO_GUEST:
                return [
                    'name' => \Yii::t('app', 'Your name'),
                    'email' => \Yii::t('app', 'Your email address'),
                    'subject' => \Yii::t('app', 'Subject'),
                    'body' => \Yii::t('app', 'Content'),
                    'verifyCode' => 'Verification Code',
                ];
            default:
                return [
                    'name' => \Yii::t('app', 'Your name'),
                    'email' => \Yii::t('app', 'Your email address'),
                    'subject' => \Yii::t('app', 'Subject'),
                    'body' => \Yii::t('app', 'Content'),
                    'verifyCode' => 'Verification Code',
                ];
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
