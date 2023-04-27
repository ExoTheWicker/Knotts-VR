<?php
function login($username, $password){
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
        'password' => $password,
        'secretMachineId' => 'owou1',
        'rememberMe' => true,
        'username' => $username
    ]),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    
    if($http_code == '400'){
        return '400';
    }else{
        return $response;
    }
    }
?>