<?php


namespace wooShopTBot;


use stdClass;

class KeyboardButton
{

    private $button;

    /**
     * @param $text
     * @param bool $request_contact
     * @param bool $request_location
     * @return KeyboardButton
     */
    public function setButton($text, $request_contact=false, $request_location=false)
    {
        $this->reset();
        $this->button->text=$text;
        $this->button->request_contact=$request_contact;
        $this->button->request_location=$request_location;

        return $this;
    }
    protected function reset(): void
    {
        $this->button = new stdClass;
    }

    public function getButton():array
    {
        $button=[];
        foreach (get_class_vars(get_class($this)) as $key => $value){
            if ($value){
                $button[$key]=$value;
            }
        }
        return $button;
    }
}