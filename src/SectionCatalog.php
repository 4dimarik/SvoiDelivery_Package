<?php


namespace wooShopTBot;


class SectionCatalog
{
    private $text;

    public function home()
    {
        $this->text = Base::SECTION_CATALOG_HOME_TEXT;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }
}