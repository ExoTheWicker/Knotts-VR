<?php
function friends($userid, $token){
    $config = json_decode(file_get_contents('config/config.json'));
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => $config->activeAPI."/users/$userid/friends",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Authorization: neos $userid:$token",
        "Content-Type: application/json"
    ],
    ]);
    $friends = json_decode(curl_exec($curl));
    $json = curl_exec($curl);
    $err = curl_error($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    foreach($friends as $friend){
        if($friend->friendStatus == 'Accepted'){
           echo '<div class="friend-'.$friend->userStatus->onlineStatus.'">';

           if(isset($friend->profile->iconUrl)){
            $asset_parts = pathinfo($friend->profile->iconUrl);
           echo'<div class="friend-profile-image" style="width:48px; height:48px; content:url('.'https://assets.neos.com/assets/'.$asset_parts['filename'].''.'); float: left"></div>';
           }else{
            echo '<div class="friend-profile-image" style="width:48px; height:48px; content:url('.'img/no-image.jpg','); float: left"></div>';
           }
           
           echo '<span style="overflow: hidden">'.$friend->friendUsername . '</span><br>
            <span class="'.$friend->userStatus->onlineStatus.'">'.$friend->userStatus->onlineStatus.'</span><br>';
            if(isset($friend->userStatus->currentSession)){
                echo 'In: <a href="/session/'.$friend->userStatus->currentSession->sessionId.'">'.$friend->userStatus->currentSession->name.'</a>';
            }elseif($friend->userStatus->onlineStatus != 'Offline'){
                if($friend->userStatus->currentSessionHidden == 'true'){
                echo 'In hidden Session';
                }else{
                    echo 'In Private World';
                }
                }      
            echo'</div>';
        }
        
    }
}
?>