<?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);


    
//Load config file
$config = json_decode(file_get_contents('config/config.json'));


//Load autoload.php to retrive functions
    require_once('inc/autoload.php');

//Define local user variable
    $user = json_decode(file_get_contents($config->activeAPI.'/users/'.$_COOKIE['Neos_userId']));

?>

<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php
            if(session($uri_segments[2], $_COOKIE['Neos_userId'], $_COOKIE['Neos_token'], 'title') != 'false'){
        
        
        echo session($uri_segments[2], $_COOKIE['Neos_userId'], $_COOKIE['Neos_token'], 'title');}else{
            echo 'Session Browser';
        }?> | Knotts-VR</title>
        <link rel="stylesheet" href="https://dev.knotts-vr.gay/css/main.css">
    </head>
    <body>
        <div class="site-main">

            <div class="user-profile-section">
                <h2>Welcome, <span><?php echo $user->username;?></span></h2>
                <p><img src="https://assets.neos.com/assets/<?php $asset_parts = pathinfo($user->profile->iconUrl); echo $asset_parts['filename']?>" style="width: 128px; height: 128px"></p>
                <?php tags($_COOKIE['Neos_userId']);?>
            </div>
            <div class="friends-section">
                <?php echo friends($_COOKIE['Neos_userId'], $_COOKIE['Neos_token'])?>
            </div>
            <div class="site-content">
                <?php 
                    if(session($uri_segments[2], $_COOKIE['Neos_userId'], $_COOKIE['Neos_token'], 'title') != 'false'){
                echo session($uri_segments[2], $_COOKIE['Neos_userId'], $_COOKIE['Neos_token'], 'all');
            }else{
                echo'Error: Session Exired, Hidden, Not Public or Not found';
            }
                ?>
            </div>
            <div class="site-footer">
               <?php include('inc/footer.php')?>
            </div>
        </div>
    </body>
</html>