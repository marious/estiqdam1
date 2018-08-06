<?php
define('ENV', 'dev');

switch (ENV) {
    case 'dev':
        define('DB_NAME','u273974407_mytw');
        define('DB_USER','u273974407_twitt');
        define('DB_PASSWORD','2634231f16');
        define('DB_HOST', 'mysql.hostinger.co.uk');
        define('URL_ROOT', 'http://estgdam1.com/mytwitterapp/');
        define('IS_PROD',false);
        break;

}




define('TWITTER_UPLOADS_POST_MAX_IMG', 4);
define('TWITTER_API_LIST_FW', 5000);
define('TWITTER_API_MAX_RETRIES',5);
define('TWITTER_API_DAYS_BEFORE_RECACHE',7);
define('UPLOAD_PATH', 'media/');
