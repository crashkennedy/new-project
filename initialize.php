<?php
// $dev_data = array('id'=>'-1','firstname'=>'Developer','lastname'=>'','username'=>'dev_oretnom','password'=>'5da283a2d990e8d8512cf967df5bc0d0','last_login'=>'','date_updated'=>'','date_added'=>'');
// if(!defined('base_url')) define('base_url','http://localhost/omos/');
// if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );
// // if(!defined('dev_data')) define('dev_data',$dev_data);
// if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
// if(!defined('DB_USERNAME')) define('DB_USERNAME',"postgres");
// if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"1234");
// if(!defined('DB_NAME')) define('DB_NAME',"omos_db");
// if(!defined('DB_PORT')) define('DB_PORT',"5432");
// if(!defined('DB_DRIVER')) define('DB_DRIVER',"pgsql");

// // Autoloader function
// spl_autoload_register(function ($class) {
//     // Base directory for the namespace prefix
//     $base_dir = __DIR__ . '/';

//     // Replace namespace separators with directory separators
//     $class = str_replace('\\', '/', $class);

//     // Build the full path to the file
//     $file = $base_dir . $class . '.php';

//     // If the file exists, require it
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });

use Config\DBConnection;
use Config\SystemSettings;

$dbConnection = new DBConnection();
$_settings = new SystemSettings($dbConnection);
$_settings->load_system_info_from_db();

?>