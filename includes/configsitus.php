<?php

//include 'id-includes/mysql.php';
 
$hasil =  $koneksi_db->sql_query("SELECT * FROM setting");
$data = $koneksi_db->sql_fetchrow($hasil);
$email_master	= $data['email_master'];
$judul_situs 	= $data['judul_situs'];
$url_situs 		= $data['url_situs'];
$slogan			= $data['slogan'];
$description	= $data['description'];
$keywords		= $data['keywords'];
$foldersitus	= $data['foldersitus'];
$_META['description'] =$description;
$_META['keywords'] = $keywords;
$theme			= $data['theme'];
$author			= $data['author'];
$_META['author']= $author;
$alamatkantor	= $data['alamatkantor'];
$publishwebsite	= $data['publishwebsite'];
$publishnews	= $data['publishnews'];
$tags			= $_META['keywords'];
$maxgalleridata = $data['maxgalleridata'];
$lightbox		= $data['lightbox'];
?>