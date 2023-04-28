<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once('inc/autoload.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $config = json_decode(file_get_contents('config/config.json'));
        
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "https://www.neosvr-api.com/api/userSessions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'password' => $_POST['password'],
        'secretMachineId' => 'owou1',
        'rememberMe' => true,
        'username' => $_POST['username']
    ]),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($http_code == 200){
            $login = json_decode($response);

            setcookie('Neos_token', $login->token, time() + (86400 * 7), "/"); // 86400 = 1 day
            setcookie('Neos_userId', $login->userId, time() + (86400 * 7), "/"); // 86400 = 1 day
            header('Location: home');
        }



    curl_close($curl);
    }else if(extend($_COOKIE['Neos_userId'], $_COOKIE['Neos_token']) == 'true'){
        header('location: home');
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
                <center>
                <div class="login-form">
                        <h1>Login to Neos</h1>
                        <p>We only transpher login data to the Neos API none of your neos data is stored locally.</p>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                        <p><span class="login-error" style="color: red"><?php echo $login_error;?></span></p>
                        <input type="text" name="username" id="username" placeholder="Username"><br>
                        <input type="password" name="password" id="password" placeholder="Password"><br>
                        <input type="submit" value="Login">
                        

                    </form>
                </div>
</center>
            </div>
            <div class="site-footer">
               <?php include('inc/footer.php')?>
            </div>
        </div>
    </body>
</html>