<?php
function extend($userid, $token){
    $config = json_decode(file_get_contents('config/config.json'));
    
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $config->activeAPI."/userSessions/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PATCH",
    CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => [
    "Authorization: neos $userid:$token",
    "Content-Type: application/json"
  ],
]);
curl_exec($curl);

$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);



$err = curl_error($curl);
curl_close($curl);
if($code == 204){
    return 'true';
}else{
    return 'false';
}
}


?>