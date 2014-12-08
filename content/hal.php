<?php

#############################################
# Teamworks Content Management System
# http://www.teamworks.co.id
# 23 Februari 2014
# Author: webmaster@teamworks.co.id
#############################################

if (!defined('CMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal=1;

global $koneksi_db,$widgetpage;

$id 	= int_filter($_GET['id']);
$judul 	= $_GET['judul'];
$hasil 	= $koneksi_db->sql_query( "SELECT * FROM halaman WHERE id='$id'" );
$data = $koneksi_db->sql_fetchrow($hasil) ;
$judul = $data['judul'];
if (empty ($judul)){
$tengah .='<div class="error">
<center>Access Denied<br /><br />Regard<br /><br />ID CMS<br />webmaster@teamworks.co.id</center></div>';
}else {
//title 
$judul_situs = ''.$judul.' | '.$judul_situs.'';

$tengah .='<h4 class="bg">'.$judul.'</h4>';
$tengah .= $data['konten'];
////////////ADD THIS////////////////////////////////////
$hasilw =  $koneksi_db->sql_query( "SELECT * FROM widget where id=$widgetpage " );
$dataw = $koneksi_db->sql_fetchrow($hasilw);
$widget=$dataw[2];
$tengah .="$widget";
///////////////////////////////////////////////////////
}

echo $tengah;

?>