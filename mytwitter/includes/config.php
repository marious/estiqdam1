<?php
define('ENV', 'dev2');

switch (ENV) {
    case 'dev2':
        define('DB_NAME','mtwitterapp');
        define('DB_USER','root');
        define('DB_PASSWORD','2634231');
        define('DB_HOST', 'localhost');
        define('URL_ROOT', 'http://localhost/estiqdam1/mytwitter/');
        define('IS_PROD',false);
        break;
    case 'dev':
        define('DB_NAME','mytwitterapp');
        define('DB_USER','root');
        define('DB_PASSWORD','2634231');
        define('DB_HOST', '127.0.0.1');
        define('URL_ROOT', 'http://192.168.100.11/');
        define('IS_PROD',false);
    break;
    case 'prod':
        define('DB_NAME','u501603252_mytw');
        define('DB_USER','u501603252_twitt');
        define('DB_PASSWORD','2634231561472');
        define('DB_HOST', 'mysql.hostinger.co.uk');
        define('URL_ROOT', 'http://estgdam1.com/mytwitter/');
        define('IS_PROD',false);
        break;

}




define('TWITTER_UPLOADS_POST_MAX_IMG', 4);
define('TWITTER_API_LIST_FW', 5000);
define('TWITTER_API_MAX_RETRIES',5);
define('TWITTER_API_DAYS_BEFORE_RECACHE',7);
define('UPLOAD_PATH', 'media/');
