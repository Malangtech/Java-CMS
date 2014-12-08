<?php

###########################################

class microTimer {
function start() {
	global $starttime;
	$mtime = microtime ();
	$mtime = explode (' ', $mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;
}

function stop() {
	global $starttime;
	$mtime = microtime ();
	$mtime = explode (' ', $mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$totaltime = round (($endtime - $starttime), 5);
	return $totaltime;
}
}

$timer = new microTimer;
$timer->start();

include 'includes/session.php';
@header("Content-type: text/html; charset=utf-8;");
ob_start("ob_gzhandler");

define('CMS_MODULE', true);
define('CMS_CONTENT', true);
define('CMS_admin', true);
include "includes/config.php";
include "includes/mysql.php";
include "includes/configsitus.php";
include "includes/template.php";
global $judul_situs,$theme;

$_GET['aksi'] = !isset($_GET['aksi']) ? null : $_GET['aksi'];
$cek = '';
if (!cek_login ()){
$cek ='<div class="alert alert-danger"><strong>Akses ditolak!</strong> Anda tidak mempunyai hak untuk akses halaman ini</div>';
header ("location:index.php");
exit;
}else{
if ($_SESSION['LevelAkses'] &&  $_SESSION['LevelAkses']=="Administrator"){
include "includes/security.php";

ob_start();
if(!isset($_GET['opsi'])){
include 'content/dashboard.php';
} else if (@$_GET['modul'] == 'yes'
&& file_exists('content/modul/'.$_GET['opsi'].'/admin/admin_'.$_GET['opsi'].'.php') 
&& !preg_match("/[\.\/]/",$_GET['opsi'])) {
include 'content/modul/'.$_GET['opsi'].'/admin/admin_'.$_GET['opsi'].'.php';	
} else if (!isset($_GET['modul']) 
&& file_exists('ngadimin/manage/'.$_GET['opsi'].'.php') 
&& !preg_match("/[\.\/]/",$_GET['opsi'])) {
include 'ngadimin/manage/'.$_GET['opsi'].'.php';	
}
else {
include 'content/dashboard.php';	
}

$content = ob_get_contents();
ob_end_clean();

if ($_GET['aksi'] == 'logout') {
logout ();
}
}

else if ($_SESSION['LevelAkses'] &&  $_SESSION['LevelAkses']=="User"){
	
include "includes/security.php";	

ob_start();
if(!isset($_GET['opsi'])){
include 'content/dashboard.php';
}else if (@$_GET['modul'] == 'yes' 
&& file_exists('content/modul/'.$_GET['opsi'].'/user/user_'.$_GET['opsi'].'.php') 
&& !preg_match("/[\.\/]/",$_GET['opsi'])){
include 'content/modul/'.$_GET['opsi'].'/user/user_'.$_GET['opsi'].'.php';	
}else {
include 'content/dashboard.php';	
}
$content = ob_get_contents();
ob_end_clean();
}else{
$cek.='<div class="alert alert-danger"><strong>Akses ditolak!</strong> Anda tidak mempunyai hak untuk akses halaman ini</div>';
}
}

#############################################
# Left Side
#############################################
ob_start();
include "content/menuadmin.php";
echo "<!-- modul //-->";
//modul(0);
echo "<!-- blok kiri //-->";
//blok(0);
echo "<!-- akhir blok //-->";
$leftside = ob_get_contents();
ob_end_clean(); 

#############################################
# Right Side
#############################################
if (!isset($index_hal)){
ob_start();
echo "<!-- modul -->";
//modul(1);
echo "<!-- blok kanan -->";
//blok(1);
$rightside = ob_get_contents();
ob_end_clean(); 
} else {
$style_include[] = '
<style type="text/css">
/*<![CDATA[*/
#main {
float: left;
margin-left: 0;
padding: 0;
width:72%;
}
/*]]>*/
</style>';	
}

#############################################
# Cek Login
#############################################
ob_start();
include "content/ceklogin.php";
$ceklogin = ob_get_contents();
ob_end_clean();

#############################################
# Menu Admin
#############################################
ob_start();
include "content/menuadmin.php";
$menuadmin = ob_get_contents();
ob_end_clean();

echo $cek;
$style_include_out 	= !isset($style_include) ? '' : implode("",$style_include);
$script_include_out = !isset($script_include) ? '' : implode("",$script_include);
$rightside 			= !isset($rightside) ? '' : $rightside;
$leftside 			= !isset($leftside) ? '' : $leftside;
$ceklogin 			= !isset($ceklogin) ? '' : $ceklogin;
$menuadmin 			= !isset($menuadmin) ? '' : $menuadmin;

$define = array (
	'menuadmin'    		=> $menuadmin,
	'leftside'    		=> $leftside,
	'ceklogin'    		=> $ceklogin,
	'url'     			=> $url_situs,
	'content'     		=> $content,
	'rightside'  		=> $rightside,
	'judul_situs' 		=> $judul_situs,
	'style_include' 	=> $style_include_out,
	'script_include' 	=> $script_include_out,
	'meta_description' 	=> $_META['description'],
	'meta_keywords' 	=> $_META['keywords'],
	'timer' 			=> $timer->stop()
);

$tpl = new template ('ngadimin/themes/administrator/administrator.html');
$tpl-> define_tag($define);

$tpl-> cetak();
//cek_license ();
?>