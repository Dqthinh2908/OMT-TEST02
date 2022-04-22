<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';



if(file_exists('route/web.php'))
{
    define('ROOT_PATH','index.php');
    require 'route/web.php';

}else
{
    echo 'Website đang được nâng cấp vui lòng quay lại sau';
}
?>