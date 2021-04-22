<?php

	session_start();


	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))    //sprawdzanie czyjestesmy zalogowni jesli tak przekieruj do profilu
	{
		header('Location: profil.php');
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Magazyn</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<body style="background-image: radial-gradient( circle farthest-corner at 1.3% 2.8%,  rgba(239,249,249,1) 0%, rgba(182,199,226,1) 100.2% );">

<header>
			<section id="nav-bar">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.php" ><img src="logo.png"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
			  <a class="nav-item nav-link " href="index.php">HOME<span class="sr-only">(current)</span></a>
			  <a class="nav-item nav-link" href="about.php">O PROJEKCIE</a>
			  <a class="nav-item nav-link " href="">KONTAKTbb</a>


			  <a href="panel_logowania.php" style="padding-top: 5px; font-size: 9px;"><button class="button" style="vertical-align:middle" ><span>zaloguj się</span></button></a>

			</div>
			</div>
			</section>
			</nav>
	</header>

<img class="wave" src="wave.png">
<div class="img_log">
			
    <div id="pole" >

		<h3 class="title1 text-center py-3">O Projekcie</h3>
<h5 style="text-align:center;">Projekt zrealizowany w ramach zajęć z przedmiotu Inżynieria Oprogramowania</h5></br>
<p><b>PWSZ Instytut Techniczny 2021</b></p>
<p><b>Autorzy:</b> Bartłomiej Tokarczyk, Mateusz Sromek, Dawid Zawiślan, Maciej Więcławek
</p>
<p><b>Kierunek: </b> Informatyka Stosowana </p>
<p><b>Przedmiot: </b> Inżynieria Oprogramowania - projekt</p>
<p><b>Prowadzący: </b> mgr inż. Józef Wójcik</p>

	
    </div>
</div>



</body>





	
		


</html>