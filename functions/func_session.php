<?php

function session($sessionid, $userid, $token, $display){
    $config = json_decode(file_get_contents('config/config.json'));
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $config->activeAPI."/sessions/$sessionid",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: neos $userid:$token"
    ],
    ]);

    $session = json_decode(curl_exec($curl));
    $err = curl_error($curl);

    $error = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    
    if($error == 200){
        if($display == 'all'){
            echo '
            <div class="session-content">
                <div class="session-thumbnail"><img src="'.$session->thumbnail.'"></div>
                <h1>'.$session->name.'['.$session->activeUsers.' ('.$session->joinedUsers.') / '.$session->maxUsers.']</h1>
                <h2>'.$session->description.'</h2>
                <h3>Joined users:</h3>
                ';
                foreach($session->sessionUsers as $user){
                    echo '<p>'.$user->username.'</p>';
                }
        
            
            echo'</div>';
            }elseif($display == 'title'){
                echo $session->name;
            }
    }else
return 'false';


}
?>