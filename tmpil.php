<?php
$host= "localhost";
$db  = "root";
$pw  = "";
$na= "absensi";
//$but = $_POST['rand'];

$c = mysqli_connect($host,$db,$pw,$na);
//$qur = mysqli_query($c,"SELECT * FROM peserta ORDER BY id WHERE status=0");
$qur = mysqli_query($c,"SELECT * FROM (SELECT * FROM peserta WHERE status='0') AS tmp ORDER BY RAND() LIMIT 1");
$qur2= mysqli_query($c, "SELECT * FROM hasil WHERE id=1");

//$qur2 = mysqli_query($c, "SELECT * FROM peserta WHERE id='$_POST[id]'");
//$qur = mysqli_query($c, "SELECT * FROM (SELECT * FROM peserta ORDER BY id DESC LIMIT 1) order by RAND()");

// while($row = $db->fetchArray()){
// 	$temp = array("id"=>$row['id'], "nama"=>$row['nama'], "organisasi"=>$row['company'], "email"=>$row['email']);
// }

$row = mysqli_fetch_array($qur);
$f = mysqli_fetch_array($qur2);
/*$temp = array("id"=>$row['id'], "nama"=>$row['fullname'], "organisasi"=>$row['city'], "email"=>$row['email']);

$data=json_encode($temp);
echo $data;*/
echo " Nama : ".$row['nama']."<br>";
//$pin = "Aztamvan1234";
if(isset($_POST['pengurus']) AND $_POST['pengurus'] == 'Aztamvan1234'){
$sql  = "INSERT INTO hasil (id, status, nama, pengurus, perwakilan, iburt, kode_unik) VALUES ('1','No','$row[nama]','1','0','0','2')";
$query= mysqli_query($c,$sql);
header('Location: arisan.php');
}elseif(isset($_POST['pengurus']) AND $_POST['pengurus'] != 'Aztamvan1234'){
header('Location: arisan.php?pesan=PIN/PASSWORD TIDAK BENAR');	
}elseif (isset($_POST['perwakilan'])) {
$sql  = "UPDATE hasil SET perwakilan= 1 WHERE id=1";
$query= mysqli_query($c,$sql);
header('Location: arisan.php');
}
//kondisi jika pihak RT sudah setuju dan memasukan kata kunci yang pass maka akan merubah status tadinya NO menjadi YES dan akan tampil siapa yang dapat bulan ini
if(isset($_POST['iburt']) AND $_POST['iburt'] == 'Azhar1234'){
$a    = $row['nama'];
$sql  = "UPDATE hasil SET status='Yes',iburt='1' WHERE id=1";
$sql3 = "UPDATE `peserta` SET `status` = '1' WHERE `peserta`.`nama` = '$f[nama]'";
mysqli_query($c,$sql3);
$query= mysqli_query($c,$sql);
header('Location: arisan.php');
}elseif(isset($_POST['iburt']) AND $_POST['iburt'] != 'Azhar1234'){
header('Location: arisan.php');
}
elseif(isset($_POST['reset']) AND $_POST['reset'] == 'Aztamvan1234'){
		$sql = "DELETE FROM hasil WHERE id= 1";
		$query= mysqli_query($c,$sql);
		header('Location: arisan.php');
}elseif(isset($_POST['reset']) AND $_POST['reset'] != 'Aztamvan1234'){
		header('Location: arisan.php');
}
/*if ($row['status']=='0') {
	$id=$row['id'];
	$db->go("UPDATE `undian` SET `status`='1' WHERE `id`='$id'");
}*/

?>