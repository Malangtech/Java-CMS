<?php
include "../includes/session.php";
include "../includes/config.php";
include "../includes/fungsi.php";

if (!cek_login ()){
header("location:../ngadimin.php");
exit;
}else{

if ($_SESSION['LevelAkses'] &&  $_SESSION['LevelAkses']=="Administrator"){
header("location:../main.php");
exit;
}else{
header("location:../ngadimin.php");
}
}
?>