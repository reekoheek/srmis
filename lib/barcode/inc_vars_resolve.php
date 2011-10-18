<?php
/**
* importGlobalVariable solves the different global variable names
* in different versions of php
* original idea by Chris Burkert
*/
function importGlobalVariable($variable)
{ 
   switch (strtolower($variable))
   { case 'server' :
          if (isset($_SERVER))  { return $_SERVER; }
          else
                 { return $GLOBALS['HTTP_SERVER_VARS']; }
           break;
/*      case 'session' :
           if (isset($_SESSION)) { return $_SESSION; }
           else
                { return $GLOBALS['HTTP_SESSION_VARS']; }
           break;*/
      case 'post' :
           if (isset($_POST))    { return $_POST; }
           else
                 { return $GLOBALS['HTTP_POST_VARS']; }
           break;
      case 'get' :
          if (isset($_GET))     { return $_GET; }
          else
                { return $GLOBALS['HTTP_GET_VARS']; }
           break;
      case 'cookie' :
          if (isset($_COOKIE))     { return $_COOKIE; }
          else
                { return $GLOBALS['HTTP_COOKIE_VARS']; }
           break;
      default:return null;
           break;
    }
}

/**
* This routine will check whether the register_globals of php is on or off.
* If it is off, all GET,POST, and COOKIE variables will be explicitely 'globalized' here
* Note: this uses the $$ variable which will not work in php3
*/
$reg_glob_ini=ini_get('register_globals');

if(empty($reg_glob_ini)||(!$reg_glob_ini))
{

/* Process GET vars */

  //if(sizeof($HTTP_GET_VARS))
  if(sizeof($global_vars=&importGlobalVariable('get')))
  {
    //while(list($x,$v)=each($HTTP_GET_VARS))    
    while(list($x,$v)=each($global_vars))
    {
		$$x=$v;
    }
    reset($global_vars);
  }
  
/* Process POST vars */
  
  //if(sizeof($HTTP_POST_VARS))
  if(sizeof($global_vars=&importGlobalVariable('post')))
  {
    //while(list($x,$v)=each($HTTP_POST_VARS)) 
    while(list($x,$v)=each($global_vars))    
    {
		$$x=$v;
    }
    //reset($HTTP_POST_VARS);
    reset($global_vars);
  }
  
/* Process COOKIE vars */

  //if(sizeof($HTTP_COOKIE_VARS))
  if(sizeof($global_vars=&importGlobalVariable('cookie')))
  {
    //while(list($x,$v)=each($HTTP_COOKIE_VARS)) 
    while(list($x,$v)=each($global_vars))
    {
		$$x=$v;
    }
    //reset($HTTP_COOKIE_VARS);
    reset($global_vars);
  }

/* Get cookie vars equivalent */
$HTTP_COOKIE_VARS=&importGlobalVariable('cookie');
 
/* Process SERVER vars */

  //if(sizeof($HTTP_SERVER_VARS))
  if(sizeof($global_vars=&importGlobalVariable('server')))
  {
    //while(list($x,$v)=each($HTTP_SERVER_VARS)) 
    while(list($x,$v)=each($global_vars))
    {
		$$x=$v;
    }
    //reset($HTTP_SERVER_VARS);
    reset($global_vars);
  }

/* Get server vars equivalent */
$CARE_SERVER_VARS=&importGlobalVariable('server');
  
/* Process SESSION vars */  
/*  if(sizeof($global_vars=&importGlobalVariable('session')))
  {
    //while(list($x,$v)=each($HTTP_SERVER_VARS)) 
    while(list($x,$v)=each($global_vars))    
    {
		$$x=$v;
    }
    //reset($HTTP_SERVER_VARS);
    reset($global_vars);
  }  
  
*/

//$HTTP_SESSION_VARS=&importGlobalVariable('session');

}

/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_vars_resolve.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>