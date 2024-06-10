<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Logger.php';
// Logger.
//$logger                 = \ArubaSPA\HiSpeedCache\Debug\Logger::class;
\ArubaSPA\HiSpeedCache\Debug\Logger::$log_dir       = dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'log';
\ArubaSPA\HiSpeedCache\Debug\Logger::$log_file_name = \md5( \get_home_url( null, '/' ) ) . '_ahscLog';
/*if ( file_exists( $logger::get_log_file_path_name() ) ) {
	\wp_delete_file( $logger::get_log_file_path_name() );
}*/
\ArubaSPA\HiSpeedCache\Debug\Logger::init();