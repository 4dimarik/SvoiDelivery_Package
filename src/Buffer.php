<?php


namespace wooShopTBot;


class Buffer
{
    /**
     * @var WP
     */
    private $wp;
    /**
     * @var Woo
     */
    private $woo;



    public function __construct()
    {
        $this->wp = new WP();
        $this->woo = new Woo();
        if (is_dir(Base::BUFFER_DIR)) {
            $this->delDir(Base::BUFFER_DIR);
        }

        $this->checkDir(Base::BUFFER_DIR);

    }

    private function checkDir($dir){
        if (!is_dir($dir)){
            mkdir($dir,0777, true);
        }
    }
    private function delDir($dir) {
        $files=array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            (is_dir($dir . '/' . $file)) ? self::delDir($dir . '/' . $file) : unlink($dir . '/' . $file);
        }
        rmdir($dir);
    }

    public function Update(){
        //Categories
        $categories = $this->woo->Categories();
        file_put_contents(Base::BUFFER_DIR.'Categories.txt', json_encode($categories));


        //AllProductsInCategory
        foreach ($categories as $category) {
            //Category
            $dir = Base::BUFFER_DIR.'categories/';
            $this->checkDir($dir);
            file_put_contents($dir.$category->id.'.txt', json_encode($category));

            //Products
            $dir = Base::BUFFER_DIR.'products/categories/';
            $this->checkDir($dir);
            $AllProductsInCategory = $this->woo->AllProductsInCategory($category->id);
            file_put_contents($dir.$category->id.'.txt', json_encode($AllProductsInCategory));
            echo json_encode($AllProductsInCategory)."<br><br>";
            foreach ($AllProductsInCategory as $product) {
                $dir = Base::BUFFER_DIR.'products/';
                $this->checkDir($dir);
                file_put_contents($dir.$product->id.'.txt', json_encode($product));
            }
        }
    }

    public function getHelp(){
        return file_get_contents(Base::BUFFER_DIR.'help.txt');
    }

    public function getDescription(){
        return file_get_contents(Base::BUFFER_DIR.'description.txt');
    }
    public function getCategories(){
        return json_decode(file_get_contents(Base::BUFFER_DIR.'getCategories.txt'));
    }
    public function getAllProductsInCategory($ci){
        return json_decode(file_get_contents(Base::BUFFER_DIR.'categories/'.$ci.'.txt'));
    }
    public function getProducts($ci, $p)
    {
        return [json_decode(file_get_contents(Base::BUFFER_DIR.'categories/'.$ci.'.txt'))[$p-1]];
    }

}