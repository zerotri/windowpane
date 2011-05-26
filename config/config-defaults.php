<?php
/*	environment:
 *	    url:                "http://zerose.co.vu"
 *	    debug:              true
 *	    mode:               development
 *	    folders:
 *	        model:          "{root}/app/m/"
 *	        views:          "{root}/app/v/"
 *	        controllers:    "{root}/app/c/"
 *	    files:
 *	        routes_file:    "{root}/config/routes.yaml"
 *	
 *	routing:
 *	    defaults:
 *	        controller:     Post
 *	        action:         Index
 *	db:
 *	    production:
 *	        database:       pop_db
 *	    development:
 *	        database:       windowpane
 *	        username:       root
 *	        password:       root
 *	        server:         :/tmp/mysql.sock
 *	    testing:
 *	        database:       pop_db_test
 */

//Build configuration tree
$Config = array();
$Config['Environment'] = array();
$Config['Environment']['Folders'] = array();
$Config['Routing'] = array();
$Config['Routing']['Defaults'] = array();
$Config['Database'] = array();
$Config['Database']['Production'] = array();
$Config['Database']['Development'] = array();
$Config['Database']['Staging'] = array();

//Fill in default values
$Config['Environment']['Url']							=	"http://zerose.co.vu";
$Config['Environment']['Debug']							=	true;
$Config['Environment']['Phase']							=	"Development";
$Config['Environment']['Folders']['Model']				=	"{root}/app/m/";
$Config['Environment']['Folders']['View']				=	"{root}/app/v/";
$Config['Environment']['Folders']['Controller']			=	"{root}/app/c/";

$Config['Routing']['Defaults']['Application']			=	"Forum";
$Config['Routing']['Defaults']['Controller']			=	"Post";
$Config['Routing']['Defaults']['Action']				=	"Index";

$Config['Database']['Production']['Database']			=	"pop_db";
$Config['Database']['Production']['Username']			=	"root";
$Config['Database']['Production']['Password']			=	"root";
$Config['Database']['Production']['Server']				=	":/tmp/mysql.sock";

$Config['Database']['Development']['Database']			=	"windowpane";
$Config['Database']['Development']['Username']			=	"root";
$Config['Database']['Development']['Password']			=	"root";
$Config['Database']['Development']['Server']			=	":/tmp/mysql.sock";

$Config['Database']['Staging']['Database']				=	"pop_db_test";
$Config['Database']['Staging']['Username']				=	"root";
$Config['Database']['Staging']['Password']				=	"root";
$Config['Database']['Staging']['Server']				=	":/tmp/mysql.sock";

include('config.php');
?>