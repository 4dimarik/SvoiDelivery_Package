<?php


namespace wooShopTBot;


use TelegramBot\Api\Types\ReplyKeyboardMarkup;

abstract class Message
{
    protected $text;
    protected $keyboard;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text=$text;
    }

    /**
     * @return mixed
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * @param mixed $keyboard
     * @param bool $oneTimeKeyboard
     * @param bool $resizeKeyboard
     */
    public function setReplyKeyboardMarkup($keyboard,$oneTimeKeyboard=true,$resizeKeyboard=true): void
    {
        $this->keyboard=new ReplyKeyboardMarkup($keyboard, $oneTimeKeyboard, $resizeKeyboard);
    }


}