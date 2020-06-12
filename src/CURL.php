<?php


namespace wooShopTBot;


class CURL
{
    protected $url;
    /**
     * @var bool|string
     */
    protected $result;
    protected $code;

    public function request(): void
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $this->result = curl_exec($ch);
        $this->code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->loggingError($ch);
        curl_close($ch);
    }

    protected function loggingError($ch):void
    {
        $errno = curl_errno($ch);
        if ($errno) {
            $db = new DB();
            $db->query($db->getDefInsertQuery(), Base::ERR_TBL, ['text'=>'CURL WP ERROR:'.$errno, 'upd'=>curl_error($ch)]);
        }

    }


}