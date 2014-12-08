<?php

#############################################
# Teamworks Content Management System
# http://www.teamworks.co.id
# 23 Februari 2014
# Author: webmaster@teamworks.co.id
#############################################

if(!function_exists('display_children')) {
function display_children($kid=0, $level=1, $order_by=0) {

global $koneksi_db;


if ($level==1){$parentx=' class="nav navbar-nav navbar-right"';}
if ($level==2){$parentx=' class="dropdown-menu" role="menu"';}
if ($level==3){$parentx=' class="dropdown-submenu" role="menu"';}
if ($level==4){$parentx=' class="dropdown-subsubmenu" role="menu"';}
if ($level==5){$parentx=' class="dropdown-subsubsubmenu" role="menu"';}

$result = @mysql_query("SELECT a.id,a.menu,a.url,MILAH.JUMLAH FROM `menu` a  LEFT OUTER JOIN (SELECT kid, COUNT(*) AS JUMLAH FROM `menu` GROUP BY kid) MILAH ON a.id = MILAH.kid WHERE a.kid=".$kid." AND a.publikasi=1 order by ordering asc");

echo '<ul'.$parentx.'>';
while ($row =  @mysql_fetch_array($result)) {

if ($row['JUMLAH'] > 0) {
echo '<li><a href="'.$row['url'].'" class="dropdown-toggle" data-toggle="dropdown">'.$row['menu'].' <span class="caret"></span></a>';
display_children($row['id'], $level + 1, $order_by);
echo "</li>";
} elseif ($row['JUMLAH']==0) {
echo '<li><a href="'.$row['url'].'">'.$row['menu'].'</a></li>';
} else;
}
echo '</ul>';
}}

echo'<div class="collapse navbar-collapse">';
echo display_children(0, 1, 0);
echo'</div>';

?>