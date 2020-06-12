<?php


namespace wooShopTBot;


use TelegramBot\Api\Types\Update;


class Request
{

    private $Update;

    /**
     * @var array
     */
    private $data = [
        "message"=>[],
        "user"=>[]
    ];

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

    public function setMessageData(): void
    {
        $this
            ->addPropertyIsNull("message","cId", $this->Update->getMessage()->getChat()->getId())
            ->addPropertyIsNull("message","mId", $this->Update->getMessage()->getMessageId())
            ->addPropertyIsNull("message","text", $this->Update->getMessage()->getText())
            ->addPropertyIsNull("message","date", $this->Update->getMessage()->getDate())
            ->addUserContact($this->Update->getMessage()->getContact());
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    private function addPropertyIsNull(string $type, string $name, string $value): Request
    {
        if (!is_null($value)){
            $this->data[$type][$name] = $value;
        }
        return $this;
    }
    private function addUserContact(string $contact): Request
    {
        if (!is_null($contact)){
            $this->data['user']['contact'] = str_replace('+7', '8', $contact);
        }
        return $this;
    }
}