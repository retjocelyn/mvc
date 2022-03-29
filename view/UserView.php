<?php 

require_once './model/DefaultPage.php';


class UserView {
    
    /**
     * @return string
     */ 
    public function displayLogin(): string
    {
        $page = new DefaultPage('login');
        $page->assemblerPage();
        return $page->getPage();
       
    }
    
    public function displayAccount(): string
    {
        $page = new DefaultPage('account');
        $page->assemblerPage();
        return $page->getPage();
       
    }
    
    public function displayRegister(): string
    {
        $page = new DefaultPage('register');
        $page->assemblerPage();
        return $page->getPage();
       
    }
    
}