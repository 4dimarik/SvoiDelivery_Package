<?php


namespace wooShopTBot;


use Config as ConfigAlias;

class MessageFromWpPage extends Message
{
    private $wp;
    public function __construct()
    {
        $this->wp = new WP();

    }

    private function setTextFromPage()
    {
        $this->wp->setUrl(ConfigAlias::WP_DESCRIPTION_PAGE);
        $answer = $this->wp->answer();
        if ($answer['code']==200){
            $this->text =  $this->clearHtml($answer['result']->content->rendered, '<strong><br>');
        } else {
            $this->text = 'Ошибка при запросе WP';
        }
    }

    private function clearHtml($html, $allowable_tags){
        $htmlText = strip_tags($html, $allowable_tags);

        $tag = ['<strong>', '</strong>', '<br>', '<br/>', '<br />'];
        $repTag = ['<b>', '</b>', "\n", "\n", "\n"];

        return str_replace($tag, $repTag, $htmlText);
    }
}