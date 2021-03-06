<?php

require_once './Repository/AbstractRepository.php';

 class ProductRepository extends AbstractRepository
{
    
    private const TABLE = "products";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    
   
    
    public function fetchCategory($category)
    {
        $data = null; 
        try {
            $query = $this->connexion->prepare('SELECT * FROM products WHERE category = :category');
            if ($query) {
                $query->bindParam(':category', $category);
                $query->execute();
                
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            die($e);
        }
        
        return $data;
    }

}