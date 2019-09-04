<?php
date_default_timezone_set('Asia/Jakarta');
$server = "localhost";
$username = "root";
$password = "";
$database = "roadto20191";

mysql_connect($server,$username,$password);
mysql_select_db($database);

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

function average($arr){
   if (!is_array($arr)) return false;
   return array_sum($arr)/count($arr);
}

function cek_session_admin(){
	$cekakses = mysql_num_rows(mysql_query("SELECT * FROM rb_guru_akses a JOIN rb_modul b ON a.id_modul=b.id_modul where a.nip='$_SESSION[id]' AND b.aktif='Ya' AND b.url LIKE '%$_GET[view]%'"));
	$level = $_SESSION[level];
	if ($level != 'superuser' AND $level != 'kepala' AND $cekakses <= '0'){
		echo "<script>document.location='index.php';</script>";
	}
}

function cek_session_guru(){
	$level = $_SESSION[level];
	if ($level != 'guru' AND $level != 'superuser' AND $level != 'kepala'){
		echo "<script>document.location='index.php';</script>";
	}
}

function cek_session_siswa(){
	$level = $_SESSION[level];
	if ($level == ''){
		echo "<script>document.location='index.php';</script>";
	}
}

function konversi($x){
   
  $x = abs($x);
  $angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  
  if($x <= 0){
    $temp = " Nol";
  }else if($x < 12){
   $temp = " ".$angka[$x];
  }else if($x<20){
   $temp = konversi($x - 10)." belas";
  }else if ($x<100){
   $temp = konversi($x/10)." ". konversi($x%10);
  }else if($x<200){
   $temp = " seratus".konversi($x-100);
  }else if($x<1000){
   $temp = konversi($x/100)." ratus".konversi($x%100);   
  }else if($x<2000){
   $temp = " seribu".konversi($x-1000);
  }else if($x<1000000){
   $temp = konversi($x/1000)." ribu".konversi($x%1000);   
  }else if($x<1000000000){
   $temp = konversi($x/1000000)." juta".konversi($x%1000000);
  }else if($x<1000000000000){
   $temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
  }
   
  return $temp;
 }
   
 function tkoma($x){
  $str = stristr($x,",");
  $ex = explode(',',$x);
   
  if(($ex[1]/10) >= 1){
   $a = abs($ex[1]);
  }
  $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
  $temp = "";
  
  $a2 = $ex[1]/10;
  $pjg = strlen($str);
  $i =1;
     
   
  if($a>=1 && $a< 12){   
   $temp .= " ".$string[$a];
  }else if($a>12 && $a < 20){   
   $temp .= konversi($a - 10)." ";
  }else if ($a>20 && $a<100){   
   $temp .= konversi($a / 10)." puluh". konversi($a % 10);
  }else{
   if($a2<1){
     
    while ($i<$pjg){     
     $char = substr($str,$i,1);     
     $i++;
     $temp .= " ".$string[$char];
    }
   }
  }  
  return $temp;
 }
  
 function terbilang($x){
  if($x<0){
   $hasil = "minus ".trim(konversi(x));
  }else{
   $poin = trim(tkoma($x));
   $hasil = trim(konversi($x));
  }
   
if($poin){
   $hasil = $hasil." koma ".$poin;
  }else{
   $hasil = $hasil;
  }
  return $hasil;  
 }

 // Kirim SMS 
 function send_sms($no,$pesan){
    
  $userkey = "8okvl6"; //userkey lihat di zenziva
$passkey = "Qwerty!@#123"; // set passkey di zenziva
$telepon = $no;
$message = $pesan;
$url = "https://reguler.zenziva.net/apps/smsapi.php";
$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$results = curl_exec($curlHandle);
curl_close($curlHandle);

$XMLdata = new SimpleXMLElement($results);
$status = $XMLdata->message[0]->text;
//echo $status;
  
  
  
  return $status;

}


function getSisaSMS(){
    $querysms = mysql_query("SELECT * FROM kuota_sms where id_kuota='1'");
    $s = mysql_fetch_array(mysql_query("SELECT * FROM kuota_sms where id_kuota='1'"));
    $kuota=$s['sisa'];

//  echo "aaaaaaaaaaaaaa";
 return $kuota;
 
}


function CountSMS(){
    
    $ss = mysql_num_rows(mysql_query("SELECT * FROM  counter_sms"));
    
    
      $s = mysql_fetch_array(mysql_query("SELECT * FROM kuota_sms where id_kuota='1'"));
    $kuota=$s['kuota'];
$sisa=$kuota-$ss;

mysql_query("update  kuota_sms set sisa='$sisa' where id_kuota='1'");

 
}


?>