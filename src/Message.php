<?php


namespace wooShopTBot;


use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Message
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
     * @return Message
     */
    public function setText($text): Message
    {
        $this->text=$text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * @param $keyboardArray
     * @param bool $oneTimeKeyboard
     * @param bool $resizeKeyboard
     * @return Message
     */
    public function setReplyKeyboardMarkup($keyboardArray, $oneTimeKeyboard=true,$resizeKeyboard=true)
    {
        $this->keyboard=new ReplyKeyboardMarkup($keyboardArray, $oneTimeKeyboard, $resizeKeyboard);
        return $this;
    }

    public function setInlineKeyboardMarkup($keyboardArray)
    {
        $this->keyboard=new InlineKeyboardMarkup($keyboardArray);
        return $this;
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
     * @return Message
     */
    public function setParseMode($parse_mode): Message
    {
        $this->parse_mode=$parse_mode;
        return $this;
    }

}