<?php
include "includes/session.php";
include "includes/config.php";
include "includes/mysql.php";
include "includes/configsitus.php";
ob_start();
cek_license ();
global $koneksi_db;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>JavaCMS System &#8250; Log In Admin</title>
<link rel="stylesheet" href="ngadimin/themes/administrator/css/reset.css">
<link rel="stylesheet" href="ngadimin/themes/administrator/css/animate.css">
<link rel="stylesheet" href="ngadimin/themes/administrator/css/id-login.css">
</head>

<body>

<?php
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
$login .= cms_login ();
}

if (!cek_login ()){
?>
<a href="/"><div class="logo-login"></div></a>

<?php
}else{

if ($_SESSION['LevelAkses']){
header("location:main.php?opsi=main");
exit;
}
}
echo $login;
?>

<div id="container">

<form method="post" action="">
<label for="name">Username</label>
<input type="name" name="username" placeholder="Username" required>
<label for="username">Password</label>
<p><a href="lupa-password.html">Lupa password?</a>
<input type="password" name="password" placeholder="Password" required>

<div id="lower">
	<label><a class="check" href="/">&laquo; Back to Site</a></label>
	<input type="hidden" value="1" name="loguser">
	<input type="submit" name="submit_login" value="Login">
</div>
</form>
</div>

</body>
</html>