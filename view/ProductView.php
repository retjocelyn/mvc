<?php 

require_once './model/DefaultPage.php';


class ProductView {
    
    /**
     * @return string
     */ 
    
    
    public function displayProduct(): string
    {
        $page = new DefaultPage('category');
        $page->assemblerPage();
        return $page->getPage();
       
    }
}