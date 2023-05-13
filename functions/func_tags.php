<?php
function tags($userId){
    $config = json_decode(file_get_contents('config/config.json')); 
    $tags = json_decode(file_get_contents($config->activeAPI.'/users/'.$userId.''));
    
    if (!is_array($tags->tags)) {
        $tags->tags = array($tags->tags);
    }

    foreach ($tags->tags as $tag) {
        if (strpos($tag, 'custom badge:',)) {
            echo '<img src="'.$config->activeAssets . str_ireplace('custom badge:', '', $tag).'" style="height: 32px; width: 32px;" title="'.$tag.'"> ';
        } else {
            echo '<img src="https://dev.knotts-vr.gay/img/neos/badges/'.$tag.'.png" style="height: 32px; width: 32px;" title="'.$tag.'"> ';
        }
    }

}


?>
