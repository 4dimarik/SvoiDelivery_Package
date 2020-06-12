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

    public function isMessage(): bool
    {
        return is_null($this->Update->getMessage());
    }

    public function isCallbackQuery(): bool
    {
        return is_null($this->Update->getCallbackQuery());
    }

}