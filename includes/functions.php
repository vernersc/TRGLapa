<?
function quote_smart($value)
{
  $value = htmlspecialchars($value);
  if (get_magic_quotes_gpc())
  {
    $value = stripslashes($value);
  }
  $value = "'" . mysql_real_escape_string($value) . "'";
  return $value;
}

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

function isLoggedIn()
{
  if($_SESSION["user_id"] != 0)
  {
  $userID = $_SESSION["user_id"];
  $query = mysql_query("SELECT password FROM accounts WHERE id = $userID");
  $uRow = mysql_fetch_assoc($query);
  $return = $uRow['password'] == $_SESSION['password'] ? true:false;
  }
  else
  {
  $return = false;
  }

  return $return;
}

function validUsername($title) {
    if (preg_replace('@([a][a?])@','',$title) ) {      

        return true;

    } else {   

        return false;

    }
}

function error($msg)
{
  return $msg;
}

function userInfo($user = '0')
{
  if(is_numeric($user))
  {
  mysql_set_charset('utf8');
  $user = $user == 0 ? (int)$_SESSION["user_id"]:$user;
  $query = mysql_query("SELECT * FROM accounts WHERE id = $user");
  }
  else
  {
  $user = quote_smart($user);
  $query = mysql_query("SELECT * FROM accounts WHERE username = $user");
  }
  $row = mysql_fetch_array($query);
  
  return $row;
}


function getUserGroup($user)
{
	if(is_numeric($user))
	{
	  $user = $user == 0 ? (int)$_SESSION["user_id"]:$user;
	  $query = mysql_query("SELECT admin FROM accounts WHERE id = $user");
	}
	else
	{
	  $user = quote_smart($user);
	  $query = mysql_query("SELECT admin FROM accounts WHERE username = $user");
	}
	$row = mysql_fetch_array($query);
	
	if ($row['admin'] == 0) {
		$grupa = "Lietotājs";
	}
	
	if ($row['admin'] == 1) {
		$grupa = "Skolas Skolotājs";
	}
	
	if ($row['admin'] == 2) {
		$grupa = "Skolas Administrators";
	}
	
	if ($row['admin'] == 3) {
		$grupa = "Lapas Administrators";
	}
	return $grupa;
}

function format_number($nr)
{
  return number_format($nr, 0, ",", " ");
}

function format_number2($nr)
{
  return number_format($nr, 0, ",", ",");
}

function format_time($endtime) {
	$starttime = time()+1;
	$timediff =	$starttime - $endtime;
	$days     =	intval($timediff/86400);
	$remain   =	$timediff%86400;
	$hours 	  =	intval($remain/3600);
	$remain   =	$remain%3600;
	$mins     =	intval($remain/60);
	$secs     =	$remain%60;
	$weeks    = intval($days/7);
	$months   = intval($days/30);
	$years   = intval($days/365);
	$gs = intval($years/100);
	$pluraldays 	= ($days == 1) ? " dienas " : " dienām ";
	$pluralweeks	= ($weeks == 1) ? " nedēļas " : " nedēļām ";
	$pluralhours 	= ($hours == 1) ? " stundas " : " stundām ";
	$pluralmins 	= ($mins == 1) ? " min." : " min. ";
	$pluralsecs 	= ($secs == 1) ? " sek. " : " sek. ";
	$pluralmonths	= ($months == 1) ? " mēn. " : " mēn. ";
  $pluralyears	= ($years == 1) ? " g. " : " g. ";
  $pluralgs	= ($gs == 1) ? " gs. " : " gs. ";
	$hourcount	= ($hours == 0) ? 1 : 0;
	$minscount	= ($mins == 0) ? 1 : 0;
	$secscount	= ($secs == 0) ? 1 : 0;
	
	if($mins == 0  and $days == 0 and $hours == 0) {
	$timediff = "pirms $secs$pluralsecs ";		
	} elseif($mins >= 1 and $hours == 0 and $days == 0) {
	$timediff = "pirms $mins$pluralmins ";		
	} elseif($hours >= 1 and $days == 0) {
	$timediff = "pirms $hours$pluralhours ";		
	} elseif($days >= 1 and $weeks == 0) {
	$timediff = "pirms $days$pluraldays ";		
	} elseif($weeks >= 1 and $months == 0) {
	$timediff = "pirms $weeks$pluralweeks ";
	} elseif($months >= 1 and $years == 0) {
	$timediff = "pirms $months$pluralmonths ";
	} elseif($years >= 1 and $gs == 0) {
	$timediff = "pirms $years$pluralyears ";
	}elseif($gs >= 1) {
	$timediff = "pirms $gs$pluralgs ";
	}
	
	return $timediff;
}

function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
	
	$days = $dtF->diff($dtT)->format('%a');
	$hours = $dtF->diff($dtT)->format('%h');
	$mins = $dtF->diff($dtT)->format('%i');
		
	if ($days == '0') {
		$outputhours = '';
	} else {
		if (($days >= '1') && ($days < '2')) {
			$outputDay = ''.$days.' Dienu';
		} else {
			$outputDay = ''.$days.' Dienas';
		}
	} 	
		
	if ($hours == '0') {
		$outputhours = '';
	} else {
		if (($hours >= '1') && ($hours < '2')) {
			$outputhours = ''.$hours.' Stundu';
		} else {
			$outputhours = ''.$hours.' Stundas';
		}
	} 
	
	if ($mins == '0') {
		$outputmins = '';
	} else {
		if (($mins >= '1') && ($mins < '2')) {
			$outputmins = ''.$mins.' Minūti';
		} else {
			$outputmins = ''.$mins.' Minūtes';
		}
	} 
		
    return (' '.$outputDay.' '.$outputhours.' '.$outputmins.'');
}

function isUserForumAdmin($user)
{
	if(is_numeric($user))
	{
	  $user = $user == 0 ? (int)$_SESSION["user_id"]:$user;
	  $query = mysql_query("SELECT admin FROM accounts WHERE id = $user");
	}
	else
	{
	  $user = quote_smart($user);
	  $query = mysql_query("SELECT admin FROM accounts WHERE username = $user");
	}
	$row = mysql_fetch_array($query);
	
	$grupa = false;
	
	if ($row['admin'] == 2) {
		$grupa = true;
	}
	
	if ($row['admin'] == 3) {
		$grupa = true;
	}
	
	return $grupa;
}
?>