<?php


namespace wooShopTBot;


use DateTime;
use DateTimeZone;
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
            ->addMessageDate($this->Update->getMessage()->getDate())
            ->addUserContact($this->Update->getMessage()->getContact());
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param NULL|string $type
     * @param NULL|string $name
     * @param NULL|string $value
     * @return Request
     */
    private function addPropertyIsNull($type, $name, $value): Request
    {
        if (!is_null($value)){
            $this->data[$type][$name] = $value;
        }
        return $this;
    }

    /**
     * @param NULL|string $contact
     * @return Request
     */
    private function addUserContact($contact): Request
    {
        if (!is_null($contact)){
            $this->data['user']['contact'] = str_replace('+7', '8', $contact);
        }
        return $this;
    }

    /**
     * @param NULL|int $getDate
     * @return Request
     */
    private function addMessageDate($getDate): Request
    {
        if (!is_int($getDate)){
            $dt = new DateTime();
            $dt
                ->setTimestamp(1591961407)
                ->setTimezone(new DateTimeZone( "Europe/Moscow" ));

            $this->data['message']['date'] = $dt->format('Y-m-d H:i:s');
        }
        return $this;
    }

}