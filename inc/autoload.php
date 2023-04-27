<?php
$folder = 'functions';
$prefix = 'func_';
$files = glob($folder . '/' . $prefix . '*');
foreach ($files as $file) {
    include $file;
}
?>