<?php

class TestUserAuthentication extends Authenticator implements IAuthentication
{
    private $userValid = 'admin';
    private $passValid = 'admin';
    private $user_id_cookie = 1;
    private $user_name = 'admin';


    private function isAuthorized()
    {
        if (empty($_SESSION['user_name'])) {
            session_start();
        }

        if (isset($_SESSION['user_name']) && $this->userValid == $_SESSION['user_name']) {
            return true;
        } else {
            if ($this->isValidCookie()) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function pushAuthorization()
    {

        if (!empty($_POST)) {
            $user = isset($_POST['user']) ? $_POST['user'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            if ($this->userValid == $user && $this->passValid == $password) {
                return true;
            } else {
                $this->errors = ['Invalid username or password'];
                return false;
            }
        } else {
            return false;
        }
    }


    private function isValidCookie()
    {
        if (!empty($_COOKIE) && isset($_COOKIE['user_id_cookie'])) {
            return $this->user_id_cookie == $_COOKIE['user_id_cookie'] ? true : false;
        } else {
            return false;
        }
    }
}


