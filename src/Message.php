<?php


namespace wooShopTBot;


use TelegramBot\Api\Types\ReplyKeyboardMarkup;

abstract class Message
{
    protected $text;
    protected $keyboard;
    protected $parse_mode=null;
    protected $disable_web_page_preview=false;
    protected $disable_notification=null;

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

    /**
     * @return null
     */
    public function getParseMode()
    {
        return $this->parse_mode;
    }

    /**
     * @param null $parse_mode
     */
    public function setParseMode($parse_mode): void
    {
        $this->parse_mode=$parse_mode;
    }

    /**
     * @return bool
     */
    public function isDisableWebPagePreview(): bool
    {
        return $this->disable_web_page_preview;
    }

    /**
     * @return null
     */
    public function getDisableNotification()
    {
        return $this->disable_notification;
    }


}