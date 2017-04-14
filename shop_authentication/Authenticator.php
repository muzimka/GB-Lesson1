<?php

/**
 * Created by PhpStorm.
 * User: MainW8
 * Date: 4/14/2017
 * Time: 10:12 PM
 */
abstract class Authenticator implements IAuthentication
{
    const AUTH_NO = '<h1>Unauthorized user</h1><br>';
    const TO_USER_REALM = 'Location:  /cookies/auth/auth.html';
    const TO_LOGIN_PAGE = 'Location:  /cookies/index.php';
    protected $errors = 0;


    public function handleLoginPage()
    {
        if ($this->isAuthorized()) {
            $this->redirectToUserPage();
        } else if ($this->pushAuthorization()) {
            $this->handleJustAuthorizedUser();
        }
    }

    public function handleUserPage()
    {
        if ($this->isAuthorized()) {
            $this->setUserCookie();
        } else {
            $this->redirectToLoginPage();
        }
    }

    public function getErrors()
    {
        if (!empty($this->errors)) {
            $str = '<ul style="color: red;">';
            foreach ($this->errors as $indx => $key) {
                $str .= '<li>' . $key . '</li>';
            }
            $str .= '</ul>';
            return $str;
        } else {
            return self::AUTH_NO;
        }
    }

    protected function handleJustAuthorizedUser(){
        $this->prosessSessionJustLoggedUser();
        $this->redirectToUserPage();
    }

    protected function prosessSessionJustLoggedUser(){
        $this->setUserCookie();
        $_SESSION['user_name']= $this->user_name;
    }
    protected function redirectToLoginPage()
    {
        header(self::TO_LOGIN_PAGE);
    }


    protected function redirectToUserPage()
    {
        header(self::TO_USER_REALM);
    }

    protected function setUserCookie(){
        setcookie('user_id_cookie',$this->user_id_cookie,time()+120,'/');
    }
}