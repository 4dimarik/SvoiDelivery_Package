<?php


namespace wooShopTBot;


use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Config;

class Woo
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client(Config::WOO['url'],
            Config::WOO['consumerKey'],
            Config::WOO['consumerSecret'],
            [
                'version' => 'wc/v3',
                'wp_api_prefix' => '/wp-json/'
            ]);
    }

    private function BufferExist($file)
    {
        if (is_file($file)){
            return json_decode(file_get_contents($file));
        } else {
            return false;
        }

    }
    public function Category($id){
        $fromBuffer = $this->BufferExist(Base::BUFFER_DIR."categories/$id.txt");
        if ($fromBuffer){
            return $fromBuffer;
        } else {
            return $this->get('products/categories', ['include' => $id]);
        }

    }
    public function AllProductsInCategory($id){
        $fromBuffer = $this->BufferExist(Base::BUFFER_DIR."products/categories/$id.txt");
        if ($fromBuffer){
            return $fromBuffer;
        } else {
            return $this->get('products', ["category" => $id, "order" => 'desc', "orderby" => 'date', "stock_status" => 'instock', "per_page" => 100]);
        }
    }
    public function Categories(){
        $fromBuffer = $this->BufferExist(Base::BUFFER_DIR.'Categories.txt');
        if ($fromBuffer){
            return $fromBuffer;
        } else {
            return $this->get('products/categories', ['per_page' => 100, 'orderby' => 'name', 'hide_empty' => true]);
        }
    }
    public function getProduct($id) {
        $fromBuffer = $this->BufferExist(Base::BUFFER_DIR.'products/'.$id.'.txt');
        if ($fromBuffer){
            return $fromBuffer;
        } else {
            return $this->client->get('products/'. $id);
        }
    }

    private function get($endpoint='', $params=[]){
        $result = '';
        try {
            $result = $this->client->get($endpoint, $params);
        } catch (HttpClientException $e) {
            $db = new DB();
            $db->query($db->getDefInsertQuery(), Base::ERR_TBL, ['text'=>$e->getMessage()]);
        }
        return $result;
    }
}