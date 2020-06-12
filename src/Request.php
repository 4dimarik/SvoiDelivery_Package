<?php


namespace wooShopTBot;


use TelegramBot\Api\Types\Update;


class Request
{
    private $Update;

    /**
     * Request constructor.
     * @param Update $Update
     */
    public function __construct(Update $Update)
    {
        $this->Update=$Update;
    }

    public static function isMessage(Update $Update): bool
    {
        return !is_null($Update->getMessage());
    }
    public static function isTextMessage(Update $Update): bool
    {
        if (self::isMessage($Update)){
            return !is_null($Update->getMessage()->getText());
        } else {
            return false;
        }

    }
}