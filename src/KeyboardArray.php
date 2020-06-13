<?php


namespace wooShopTBot;

class KeyboardArray
{
    protected $keyboardArray=[];
    /**
     * @var Catalog
     */
    private $catalog;
    /**
     * @var KeyboardRow
     */
    private $keyboardRow;

    public function __construct()
    {
        $this->catalog = new Catalog();
        $this->keyboardRow = new KeyboardRow();
    }

    public function Catalog()
    {
        $catalog = $this->catalog
            ->new()
            ->newCategory()
            ->getCatalog();

        $this->addRow($this->keyboardRow->newCategory($catalog));
        return $this->keyboardArray;
    }
    private function addRow($row)
    {
        array_push($this->keyboardArray, $row);
        return $this;
    }

}