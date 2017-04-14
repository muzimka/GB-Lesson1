<?
    require_once(__DIR__.'/TestUserAuthentication.php');
    $checker= new TestUserAuthentication;
    $checker->handleLoginPage();    
?>
<!DOCTYPE html>

<html lang="ru">
    <head>        
        <title>Login page</title>        
    </head>
    <style>
        input{
        display: block;
        margin-bottom: 15px;
        }
    </style>
<body>
    <?=$checker->getErrors();?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    <label for="user">Login:</label>
    <input type="text" name="user" id="user">
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <button type="submit">Send</button>

</form>

</body>
</html>