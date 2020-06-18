<?php


namespace wooShopTBot;

class InlineKeyboardButton{

    /**
     * @param $text
     * @param string $callback_data
     * @return array
     */
    public function setCallbackButton($text, $callback_data='{}')
    {
        $button = [];
        $button['text']=$text;
        $button['callback_data']=$callback_data;

        return $button;
    }
/*    public function setUrlButton($text, $url='#')
    {
        $this->reset();
        $this->button->text=$text;
        $this->button->url=$url;

        return $this;
    }*/
}