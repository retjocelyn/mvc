<?php 

require_once './model/DefaultPage.php';


class HomeView {
    
    /**
     * @return string
     */ 
    public function displayHome(): string
    {
        $page = new DefaultPage('home');
        $page->assemblerPage();
        return $page->getPage();
       
    }
    
}