<?php 
require_once './view/UserView.php';
require_once './Repository/UserRepository.php';
require_once './model/class/User.php';

class UserController {
    
    private $view;
    
    
     public function __construct()
    {
        $this->view = new UserView();
        $this->repository = new UserRepository();
    }
    
    public function login(){
        echo $this->view->displayLogin();
    }
    
    public function loginSecurity(): void 
    {
        if(!isset($_POST['email'], $_POST['password'])){
            header('location: ./index.php?url=login');
            exit();
        }
        
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $data = $this->repository->fetchLogin($email);
             
           
        if($data){
           
            if(!password_verify($password, $data['password'])){
                header('location: ./index.php?url=login');
                exit();
            }
            
            $user = new User();
            $user->setid($data['id']);
            $user->setlastName($data['last_name']);
            $user->setFirstName($data['first_name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRole($data['role']);
            $user->setAdresse($data['adress']);
            
          
            $_SESSION['user'] = $user->getlastName();
            
            header('location: ./index.php?url=account');
            exit();
        } 
        else {
            header('location: ./index.php?url=login');
            exit();
        }
        
    }
    
    public function account()
    {
         echo $this->view->displayAccount();
    }
    
    public function register()
    {
        echo $this->view->displayRegister();
    }


}






