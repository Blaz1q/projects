<?php
	function wyslij(){
		$conn = mysqli_connect("localhost","root","","baza");
		if(!$conn) die(mysqli_connect_error());
		else{
			$zap = "INSERT INTO rezerwacje VALUES(NULL,NULL,$_POST['data'],$_POST['osoby'],$_POST['nr_tel'])";
			$res = mysqli_query($conn,$zap);
			echo "Dodano rezerwację do bazy";
		}
		mysqli_close($conn);
	}
?>