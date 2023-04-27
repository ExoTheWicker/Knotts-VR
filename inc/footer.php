<?php
//Load Config file
$conf = json_decode(file_get_contents('config/config.json'));
echo '
<hr>
<span class="site-software-about">Running<span style="color: lime;"> '.$conf->siteName.'</span> Version: '.$conf->siteVersion.'</span>';
?>