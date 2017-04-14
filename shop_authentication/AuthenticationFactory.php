<?php

/**
 * Created by PhpStorm.
 * User: MainW8
 * Date: 4/14/2017
 * Time: 9:56 PM
 */
include_once __DIR__.'TestUserAuthentication.php';

class AuthenticationFactory
{
    const TEST_USER = 0;
    const DATABASE_USER = 1;
    private static $instance;

    /**
     * AuthenticationFactory constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance($type){
        if($type==0){
            return empty(self::$instance) ? new TestUserAuthentication() : self::$instance;
        }
        if($type==1){
            return empty(self::$instance) ? new DatabaseUserAuthentication() : self::$instance;
        }
    }
}