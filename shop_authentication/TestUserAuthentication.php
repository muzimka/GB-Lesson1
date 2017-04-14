<?

class TestUserAuthentication{
    private $userValid = 'admin';
    private $passValid = 'admin';
    public $errors = 0;
    private $user_id_cookie = 1;
    private $user_name ='admin';   
    const AUTH_NO = '<h1>Unauthorized user</h1><br>';
    const TO_USER_REALM = 'Location:  /cookies/auth/auth.html';
    const TO_LOGIN_PAGE = 'Location:  /cookies/index.php';
    
    
public function handleLoginPage(){
    if($this->isAuthorized()){
        $this->redirectToUserPage();
    }else if($this->pushAuthorization()){
        $this->handleJustAuthorizedUser();
    }
}

public function handleUserPage(){           
    if($this->isAuthorized()){        
        $this->setUserCookie();
    }else{
        $this->redirectToLoginPage();
    }
}

private function isAuthorized(){    
    if(empty($_SESSION['user_name'])){
        session_start();    }      
        
     if(isset($_SESSION['user_name']) && $this->userValid == $_SESSION['user_name']){
         return true;
     }else{
        if($this->isValidCookie()){                
            return true;
        }else{
            return false;
        }         
     }      
}

private function pushAuthorization(){
    
    if(!empty($_POST)){
        $user = isset($_POST['user'])? $_POST['user'] : '';
        $password = isset($_POST['password'])? $_POST['password'] : '';
            if($this->userValid==$user && $this->passValid == $password){
                return true;
            }else{
                $this->errors = ['Invalid username or password'];
                return false;            
            }
    }else{
        return false;
    }
}

private function handleJustAuthorizedUser(){
    $this->prosessSessionJustLoggedUser();
    $this->redirectToUserPage();
}
private function prosessSessionJustLoggedUser(){    
    $this->setUserCookie();
    $_SESSION['user_name']= $this->user_name;    
}

private function redirectToLoginPage(){
    header(self::TO_LOGIN_PAGE);
}

private function redirectToUserPage(){
    header(self::TO_USER_REALM);    
}


private function setUserCookie(){
    setcookie('user_id_cookie',$this->user_id_cookie,time()+120,'/');    
}


public function getErrors(){
    
    if(!empty($this->errors)){
    $str = '<ul style="color: red;">';
    foreach($this->errors as $indx => $key){
        $str .= '<li>'.$key.'</li>';
    }
    $str.='</ul>';
    return $str;
    }else{
        return self::AUTH_NO;
    }
}

private function isValidCookie(){    
    if(!empty($_COOKIE) && isset($_COOKIE['user_id_cookie'])){
        return $this->user_id_cookie == $_COOKIE['user_id_cookie'] ? true : false;    
    } else{        
        return false;
    }    
   } 
}


