<?php


namespace wooShopTBot;


class KeyboardButton
{
    protected $text;
    protected $request_contact=false;
    protected $request_location=false;

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text=$text;
    }

}