<?php


namespace wooShopTBot;


class MessageFromWpPage extends Message
{
    private $wp;
    public function __construct()
    {
        $this->wp = new WP();
    }

    public function setTextFromPage($page)
    {
        $this->wp->setUrl('/pages/'.$page['id']);
        $answer = $this->wp->answer();
        if ($answer['code']==200){
            $this->text = $this->clearHtml($answer['result']->content->rendered, $page['allowable_tags']);
            $this->setParseMode('html');
        } else {
            $this->setText('Ошибка при запросе WP');
        }
        return $this;
    }


    private function clearHtml($html, $allowable_tags){
        $htmlText = strip_tags($html, $allowable_tags);

        $tag = ['<strong>', '</strong>', '<br>', '<br/>', '<br />'];
        $repTag = ['<b>', '</b>', "\n", "\n", "\n"];

        return str_replace($tag, $repTag, $htmlText);
    }

    private function setKeyboardArray($name)
    {
        $keyboardArray = new KeyboardArray($name);
        $this->setReplyKeyboardMarkup();

    }
}