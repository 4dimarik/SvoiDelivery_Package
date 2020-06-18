<?php


namespace wooShopTBot;


class KeyboardRow
{
    /**
     * @var KeyboardButton
     */
    private $keyboardButton;
    /**
     * @var InlineKeyboardButton
     */
    private $inlineKeyboardButton;


    public function __construct()
    {
        $this->keyboardButton =  new KeyboardButton();
        $this->inlineKeyboardButton = new InlineKeyboardButton();
    }


    public function newCategory($catalog)
    {
        $row = [];
        $text = sprintf("%s 🍺 [%s]", $catalog->newCategory->name, $catalog->newCategory->count);
        $callback_data = [
            "a"=>"ncat"
        ];

        array_push($row, $this->inlineKeyboardButton->setCallbackButton($text)); //,json_encode($callback_data)
        return $row;
    }
}