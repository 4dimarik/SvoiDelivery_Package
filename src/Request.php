<?php


namespace wooShopTBot;


use TelegramBot\Api\Types\Update;


class Request
{
    const MESSAGE_FIELDS = ["cId", "mId", "text"];
    const USER_FIELDS = ["uid", "first_name", "contact"];
    private $Update;

    /**
     * @var array
     */
    private $data = [
        "message"=>[]
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
    public function gettData(string $type): void
    {
        switch ($type){
            case'message':
                $this->setMessageData();
                break;
            default:
                break;
        }
    }

    private function setMessageData(): void
    {
        $this
            ->addPropertyIsNull("cId", $this->Update->getMessage()->getChat()->getId())
            ->addPropertyIsNull("mId", $this->Update->getMessage()->getMessageId())
            ->addPropertyIsNull("text", $this->Update->getMessage()->getText())
            ->addPropertyIsNull("date", $this->Update->getMessage()->getDate())
            ->addUserContact($this->Update->getMessage()->getContact());
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    private function addPropertyIsNull(string $name, string $value): Request
    {
        if (!is_null($value)){
            $this->data[$name] = $value;
        }
        return $this;
    }
    private function addUserContact(string $contact): Request
    {
        if (!is_null($contact)){
            $this->data['contact'] = str_replace('+7', '8', $contact);
        }
        return $this;
    }
}