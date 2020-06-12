<?php


namespace wooShopTBot;


use Config as ConfigAlias;

class WP extends CURL
{
    /**
     * @param string $endpoint
     */
    public function setUrl($endpoint=''): void
    {
        $this->url=ConfigAlias::WP_URL.$endpoint;
    }

    public function answer(): array
    {
        $this->request();
        return ["code"=>$this->code, "result"=>json_decode($this->result)];
    }


}