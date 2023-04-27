<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
include_once('inc/autoload.php');





if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(login($_POST['username'], $_POST['password']) != '400'){
        $login = json_decode(login($_POST['username'], $_POST['password']));

        //Set token as a cookie

        setcookie('Neos_token', $login->token, time() + (86400 * 7), "/"); // 86400 = 1 day
        setcookie('Neos_userId', $login->userId, time() + (86400 * 7), "/"); // 86400 = 1 day
        header('Location: home');
    }else{
        echo 'false';}
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Knotts-VR | Home</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="site-main">
            <div class="page-content">
                <div class="login-form">
                    <form action="" method="POST">
                        <input type="text" name="username" id="username" placeholder="Username"><br>
                        <input type="password" name="password" id="password" placeholder="Password"><br>
                        <input type="submit">
                        

                    </form>
                </div>
            </div>
            <div class="site-footer">
               <?php include('inc/footer.php')?>
            </div>
        </div>
    </body>
</html>