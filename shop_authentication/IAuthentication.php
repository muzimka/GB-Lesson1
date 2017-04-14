<?php

/**
 * Created by PhpStorm.
 * User: MainW8
 * Date: 4/14/2017
 * Time: 10:08 PM
 */
interface IAuthentication
{
    public function handleLoginPage();
    public function handleUserPage();
    public function getErrors();
}