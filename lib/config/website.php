<?php
/**
 * website.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

require_once dirname( dirname( __FILE__ ) ) ."/controller/Config/SystemConfig.php";

/////////////
// FILE INFOS
/////////////

// Set root directory
SystemConfig::set( 'root', dirname( dirname( dirname( __FILE__ ) ) ) );
// Set lib directory
SystemConfig::set( 'lib', SystemConfig::get( 'root' ) ."/lib" );
// Set app directory
SystemConfig::set( 'app', SystemConfig::get( 'root' ) ."/app" );


////////////
// URL INFOS
////////////

// Set url hoster
SystemConfig::set('urlhost', 'http://'. $_SERVER['SERVER_NAME']);
// Set url script name
SystemConfig::set('urlname', str_replace( '\\', '/', dirname( dirname( $_SERVER['SCRIPT_NAME'] ) ) ) );

// If url script name is null
if( SystemConfig::get( 'urlname' ) == '/' ){
	SystemConfig::set( 'urlfolder', '' );
}
else{
	SystemConfig::set( 'urlfolder', SystemConfig::get('urlname') );
}
// Set url to parse
SystemConfig::set( 'urlparse', str_replace( SystemConfig::get('urlfolder'), "", $_SERVER['REQUEST_URI'] ) );


/////////////
// HASH INFOS
/////////////

SystemConfig::set( 'hash', 'Jude7éçèdeny\"_uiiuih\"c_èé\"èu\'fè_y\"çuçàiéjnd\"-yè637Y\"\"hsygd8dé_éebhygèç398' );