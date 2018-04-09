
<html>
	<head>
		<title>Arisan RT ONLINE</title>
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<script src="./assets/js/jquery.min.js"></script>
		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js?code=arni"></script>-->
		<script type="text/javascript">
	     var i = 0;
		function change() {
	      var doc = document.getElementById("marquee");
	      var color = ["blue", "lightblue", "red", "tomato", "green", "lightgreen", "darkorange", "orange", "black"];
	      doc.style.color = color[i];
	      i = (i + 1) % color.length;
	    }
	    setInterval(change, 1000);
		</script>
		<script>
		var myVar = setInterval(function(){ start() }, 100);

		function start() {
		$("#responsecontainer").load('tmpil.php');
		}

		function myStopFunction() {
		    clearInterval(myVar);
		}


		</script>

		
		<script type="text/javascript">

		function play() {
			var count=10;
			var counter=setInterval(timer, 1000);
			function timer() {
				count=count-1;
				if (count == -1) {
					clearInterval(counter);
					window.location.href = "./ran.php";
				} else {
					if (count > 0) {
						document.getElementById("timer").innerHTML=count + " detik, otomatis refresh!";
					} else {
						document.getElementById("timer").innerHTML="Selesai, refresh sekarang!";
					}
				}
			}
		} 
		function pesan() {
			if (confirm("Apakah yakin mengubah data ini?") == true) {
			    return true;
			} else {
			    return false;
			} 
		}
		var url_string = window.location.href;
		var url = new URL(url_string);
		var refresh = url.searchParams.get("refresh");
		if (refresh) {
			if (refresh != 0) {
				var s = parseInt(refresh+"000");
				setTimeout("window.location.reload(true)", s);
			} else {
				alert("Waktu auto refresh belum di set!");
			}
		}
		</script>		
	</head>
	<body style="background-color: grey;">
<?php
$host= "localhost";
$db  = "root";
$pw  = "";
$na= "absensi";
//$but = $_POST['rand'];

$c = mysqli_connect($host,$db,$pw,$na);

$q = mysqli_query($c,"SELECT * FROM (SELECT * FROM peserta ORDER BY id) AS tmp ORDER BY RAND() LIMIT 1");
$q2= mysqli_query($c, "SELECT * FROM hasil LIMIT 1");
$f  = mysqli_fetch_array($q2);
$ff = mysqli_fetch_array($q);
?>
<?php
if($f['status'] == 'Yes'){
	echo "<br><br><br><br><br><h1 align='center'>SELAMAT :)</h1>";
	echo "<h4 align='center' class='alert alert-warning'>Nama : ".$f['nama']."</h4>";
	echo "<h4 align='center' class='alert alert-info'>Selamat untuk ibu/ bapak <b><i>".$f['nama']."</b></i> Mendapatkan Arisan Bulan Ini</h4>";
	?>
	<form action="tmpil.php" method="post">
	<h4 align='center' class='alert alert-default'><input type="password" name="reset" placeholder="UNTUK RESET"\></h4>
	</form>
<?php
}elseif($f['status'] != 'Yes'){
	echo "<div class='row'>";
	echo "<br><br><br><br><br><marquee id='marquee'><h1><i>ARISAN RT04 Kel.Pengadegan Kec.Pancoran :)</i></h1></marquee>";
	echo "</div>";
	?>
	<h1 align="center"><button class="btn btn-warning" id="responsecontainer"> Random Sekarang </button></h1>
	<form action="tmpil.php" method="post" value="<?php echo $ff['private_id'];?>">
	<input type="hidden" name="private_id">
	<?php
	//jika pengurus udh submit jadi disable dan tinggal tunggu 2 oran lagi untuk mendapatkan hasilnya
	if($f['pengurus']== 1){
		echo '<h1 align="center" class="btn-success">Pengurus 1 Sudah SETUJU</h1> ';
	}else{
		echo '<h1 align="center"><input type="password" name="pengurus" placeholder="Masukan PIN Pengurus"\></h1>';
	}
	if($f['perwakilan']== 1){
		echo '<h1 align="center" class="btn-info">Perwakilan 1 Sudah SETUJU</h1>';
	}else{
		echo '<h4 align="center"><input type="submit" name="perwakilan" class="btn btn-danger" value="Perwakilan Anggota"\></h4>';
	}

	if($f['perwakilan'] != 1){


	}else{


	if($f['iburt']== 1){
		echo '<h1 align="center"><input type="submit" name="iburt" class="btn btn-success" value="IBU RT sudah Pencet" disable\></h1>';
	}else{
		echo '<h1 align="center"><input type="password" name="iburt" placeholder="Masukan Pin Anda Bu RT"></h1>';
	}
    }
	?>
	</form>

	<?php
}
/*elseif($q3){
	echo "<h1 align='center'><img src='./1234.png'></h1>";
	echo "<br><br><br><br><br><h1 align='center'>TEKAN TOMBOL STOP</h1>";
	
	/*echo '<form action="" method="post">
	<input type="hidden" name="timer" id="timer" value="10">
	<h1 align="center"><button class="btn btn-warning" id="load"> Random Sekarang </button></h1>
	</form>';

	echo '<h1 align="center"><button class="btn btn-warning" id="responsecontainer"> Random Sekarang </button></h1>';
	?>
	
	<?php
	
}*/




/*while ($f = mysqli_fetch_array($q)) {
	//print_r($f[1]);
	echo "<h1 align='center'>Nama : ".$f[2]."</h1>";
	echo "<h1 align='center'>ID: ".$f[1]."</h1>";
}*/
?>

</body>
</html>