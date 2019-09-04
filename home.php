<?php 

if(isset($_GET['view'])){
    $page=htmlentities($_GET['view']);
}else{
    $page="application/home_admin_row1.php";
}

$file="application/$page.php";
$cek=strlen($page);

if($cek>25 || !file_exists($file) || empty($page)){
    include ("application/home_admin_row1.php");
}else{
    include ($file);
}


?>