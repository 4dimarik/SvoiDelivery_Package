<?php


namespace wooShopTBot;


use stdClass;

class KeyboardArray
{
    protected $keyboardArray;

    public function __construct($name)
    {
        $this->$name();
    }

    protected function reset(): void
    {
        $this->keyboardArray = new stdClass;
    }

    public function keyboardArray()
    {
        $this->reset();
        return $this;
    }

    public function button()
    {
        $this->keyboardArray->row[]='asd';

    }
}