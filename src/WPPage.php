<?php


namespace wooShopTBot;


class WPPage
{
    private $wp;
    private $text;
    public function __construct($page)
    {
        $this->wp = new WP();
        $this->setText($page['id'], $page['allowable_tags']);
    }

    /**
     * @param $id
     * @param $allowable_tags
     */
    public function setText($id, $allowable_tags): void
    {
        $this->wp->setUrl('/pages/'.$id);
        $answer = $this->wp->answer();
        if ($answer['code']==200){
            $this->text = $this->clearHtml($answer['result']->content->rendered, $allowable_tags);
        } else {
            $this->text = Base::ERR_WP_MSG;
        }
    }
    private function clearHtml($html, $allowable_tags){
        $htmlText = strip_tags($html, $allowable_tags);

        $tag = ['<strong>', '</strong>', '<br>', '<br/>', '<br />'];
        $repTag = ['<b>', '</b>', "\n", "\n", "\n"];

        return str_replace($tag, $repTag, $htmlText);
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
}