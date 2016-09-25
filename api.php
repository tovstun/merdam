<?php

	/**
	 * Main Bootstrap file
	 * 
     * DO NOT MODIFY THIS FILE!
     *
	 * @author Adrian Slowik
	 * @package Shoper
	 */
	  
	// manage errors
	ini_set( 'display_errors', 'off' );
	if(version_compare(PHP_VERSION, '5.4.0', '<')) {
            error_reporting( E_ALL ^ (E_NOTICE | E_USER_NOTICE) );
        }else{
            error_reporting( E_ALL ^ (E_NOTICE | E_USER_NOTICE | E_STRICT) );
        }
	
	define( 'PATH_ROOT', dirname( __FILE__ ) );
	define( 'BASE_URL', '/');
    define( 'PHP_TAB', "\t");

    $include_paths = explode(PATH_SEPARATOR, get_include_path());

    $open_basedir = ini_get('open_basedir');
    if(!empty($open_basedir)){
        $open_basedir_paths = explode(PATH_SEPARATOR, $open_basedir);
        $included_paths = array();
        foreach($include_paths as $path){
            $path = realpath($path);
            foreach($open_basedir_paths as $restricted){
                if(strpos($path, $restricted) === 0){
                    $included_paths[] = $path;
                    break;
                }
            }
        }
    }else{
        $included_paths = $include_paths;
    }

    set_include_path( 
    	realpath(PATH_ROOT . '/application/core/')
		. PATH_SEPARATOR . realpath(PATH_ROOT . '/application/models/')
        . PATH_SEPARATOR . realpath(PATH_ROOT)
        . PATH_SEPARATOR . realpath(PATH_ROOT . '/libraries/')
        . PATH_SEPARATOR . implode(PATH_SEPARATOR, $included_paths)
	);
    
	require "InitApi.php";
?>