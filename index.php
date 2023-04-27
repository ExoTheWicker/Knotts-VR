<?php
/* Knotts-VR V1.0.2 */
/* Original Code by: ExoTheWicker#1294 */

//Load config file
    $config = json_decode(file_get_contents('config/config.json'));


//Load autoload.php to retrive functions
    require_once('inc/autoload.php');

//Define local user variable
    $user = json_decode(file_get_contents($config->activeAPI.'/users/'.$_COOKIE['Neos_userId']));

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home | Knotts-VR</title>
        <!-- LOAD CSS FILES AND LIBARIES -->
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="site-main">
            <div class="site-header">
                <?php include('inc/header.php');?>
            </div>
            <div class="site-content">
                <div class="user-profile-section">
                    <h1>Welcome, <?php echo $user->username?></h1>
                    <span class="user-tags"><?php echo tags($_COOKIE['Neos_userId'])?></span>
                </div>
                <div class="friends-section">
                    <?php friends($_COOKIE['Neos_userId'], $_COOKIE['Neos_token'])?>
                </div>
            </div>
            <div class="site-footer">
                <?php include('inc/footer.php');?>
            </div>
        </div>
    </body>
</html>
