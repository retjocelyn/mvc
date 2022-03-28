<?php

require_once './Repository/AbstractRepository.php';

 class UserRepository extends AbstractRepository
{
    
    private const TABLE = "Users";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    
   
    
    public function fetchLogin($email)
    {
        $data = null;
        try {
            $query = $this->connexion->prepare('SELECT * FROM Users WHERE email = :email');
            if ($query) {
                $query->bindParam(':email', $email);
                $query->execute();
                
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            die($e);
        }
        
        return $data;
    }
    
}