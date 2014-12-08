<?php


if (!defined('CMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}

function select_value ($name, $selected, $value = array (),$opt='',$alert='',$pilihan='-pilih-') {

$admin ="<select name='$name' size='1' $opt $alert>"; 
$admin .="<option value=''>$pilihan</option>";
if (is_array ($value)){
foreach ($value as $k=>$v) {
if (strtolower($k) == strtolower($selected)){
$admin .="<option value=\"".$k."\" selected>$v</option>";
}else {
$admin .="<option value=\"".$k."\">$v</option>";
}
}
}  
$admin .="</select>";
return $admin;	
}

function input_form ($alert, $nama, $value, $size=28, $type='text',$option=''){
if (!empty($value)) {$values = 'value="'.$value.'"';}else {$values='';}
$txt = "<input $alert onblur=\"$nama.style.color='#6A8FB1'; this.className='inputblur'\" onfocus=\"$nama.style.color='#FB6101'; this.className='inputfocus'\" type='$type' name='$nama' size='$size' $values $option>";
return $txt;	
}

?>