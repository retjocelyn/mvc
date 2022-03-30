<?php 

require_once './Repository/ProductRepository.php';
require_once './model/class/Product.php';
require './view/ProductView.php';

class ProductController {
    
    private $view;
    
    public function __construct(){
        $this->view = new ProductView();
        $this->repository = new ProductRepository();
    }
    
    
    public function category($category){
        $datas = $this->repository->fetchCategory($category);
        $products = [];
        
        foreach($datas as $data){
            $product = new Product();
            $product->setId($data['id']);
            $product->setName($data['name']);
            $product->setQuantity($data['quantity']);
            $product->setPrice($data['price']);
            $product->setUrlPicture($data['url_picture']);
            $product->setDescription($data['description']);
            $product->setCategory($data['category']);
            
            $products[] = $product;
            var_dump($products);die();
        }
        
        $this->view->dislplayCategory($products);
    }
     
}