<?php

//error_reporting(0);
error_reporting(E_ALL^E_NOTICE);

#############################################
# Konfigurasi Database
#############################################
define('CMS_FUNC', true);

$mysql_user 	= 'user';
$mysql_password = 'password';
$mysql_database = 'databasename';
$mysql_host 	= 'localhost';

#############################################
# Konfigurasi Situs dan Admin
#############################################
$adminfile = 'ngadimin'; //silahkan di ganti dan jangan lupa merename file admin.php  sesuai dg yang anda ganti
$editor ='1';  //Jika menggunakan WYSIWYG isi 1 jika tidak 0
$name_blocker = '';
$mail_blocker = '';

$translateKal = array( 
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu',
	'Sun' => 'Minggu',
	'Jan' => 'Januari',
	'Feb' => 'Februari',
	'Mar' => 'Maret',
	'Apr' => 'April',
	'May' => 'Mei',
	'Jun' => 'Juni',
	'Jul' => 'Juli',
	'Aug' => 'Agustus',
	'Sep' => 'September',
	'Oct' => 'Oktober',
	'Nov' => 'Nopember',
	'Dec' => 'Desember');

if (file_exists('includes/fungsi.php')){
include 'includes/fungsi.php';
}

if (substr(phpversion(),0,3) >= 5.5) {
date_default_timezone_set('Asia/Jakarta');



}
?>