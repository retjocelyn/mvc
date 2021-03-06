<?php 
require_once './view/UserView.php';
require_once './Repository/UserRepository.php';
require_once './model/class/User.php';

class UserController {
    
    /*private $view; interet???*/
    
    
     public function __construct()
    {
        $this->view = new UserView();
        $this->repository = new UserRepository();
    }
    
    public function login(){
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
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
             
        if(!$_POST['CSRFtoken'] === $_SESSION['csrf']){
            echo 'Mot de passe incorrect';
        }
        
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
            $user->setWallet($data['wallet']);
            
            $_SESSION['user'] = serialize($user);
            
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
        if(!isset($_SESSION['user'])){
            header('location: ./index.php?url=login');
            exit();
        }
         echo $this->view->displayAccount();
    }
    
    public function register()
    {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        echo $this->view->displayRegister();
    }

   public function registerSecurity() : void
    {
    
        if(!isset($_POST['lastName'],$_POST['firstName'],$_POST['email'], $_POST['password'],$_POST['adress'])){
                header('location: ./index.php?url=register');
                exit();
            }
        
        if(!$_POST['CSRFtoken'] === $_SESSION['csrf']){
            echo 'Mot de passe incorrect';
        }
        
        if(isset($_POST['lastName'],$_POST['firstName'],$_POST['email'], $_POST['password'],$_POST['adress']))
        {
            $newlastName = $_POST['lastName'];
            $newfirstName = $_POST['firstName'];
            $newEmail = $_POST['email'];
            $newAdress = $_POST['adress'];
            $newPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $date;
            $wallet = 0;
           
            $_SESSION['user'] = $newlastName;
            var_dump($_SESSION['user']);
           
            $this->repository->createUser($newlastName,$newfirstName,$newEmail,$newPass,$newAdress,$wallet);
            
            $_SESSION['user'] = $newlastName;
            
            
            header('location: ./index.php?url=account');
            exit();
        }
    }
    
    public function logout() : void
    {
        session_destroy();
        header('location: ./index.php?url=home');
        exit();
    }
}






