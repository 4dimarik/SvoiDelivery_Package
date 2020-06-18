<?php


namespace wooShopTBot;



class Catalog
{
    /**
     * @var Woo
     */
    private $woo;
    private $catalog;

    public function __construct()
    {
        $this->woo = new Woo();
    }

    public function getCatalog()
    {
        return $this->catalog;
    }

    protected function reset(): void
    {
        $this->catalog = new \stdClass;
    }

    public function new()
    {
        $this->reset();
        return $this;
    }

    public function newCategory(): Catalog
    {
        $category = $this->woo->category(\Config::NEW_CATEGORY_ID);
        $this->catalog->newCategory = new \stdClass;
        $this->catalog->newCategory->name = $category->name;
        $this->catalog->newCategory->count = $category->count;
        return $this;
    }





}