<?
ob_start();
$HTTP_REFERER = getenv('HTTPS_REFERER');

### Savienojamies ar DB ###
	define('DBHOST', 'host2.itap.lv');
	define('DBUSER', 'trg_db');
	define('DBPASS', 'parole9417');
	define('DBNAME', 'trg_db');
	
	$conn = mysql_connect(DBHOST,DBUSER,DBPASS);
	$dbcon = mysql_select_db(DBNAME);
	
	if ( !$conn ) {
		
	}
	
	if ( !$dbcon ) {
		
	}
####  savienojamies ar db  ####
?>