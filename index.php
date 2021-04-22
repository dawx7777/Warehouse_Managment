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
			  <a class="nav-item nav-link " href="">KONTAKT</a>


			  <a href="index.php" style="padding-top: 5px; font-size: 9px;"><button class="button" style="vertical-align:middle" ><span>zaloguj się</span></button></a>

			</div>
			</div>
			</section>
			</nav>
	</header>
<div id="logowanie">
<img class="wave" src="wave.png">
		<div class="img_log">
			
<div id="panel">

		


			
		
	<form action="login.php" method="post">
	<label for="username">E-mail</label>
	<input type="text" id="username" name="login">
	<label for="password">Hasło:</label>
	<input type="password" id="password" name="haslo">
	<div id="lower">

	<input type="submit" value="Zaloguj się">
	</label>
	</div>
	</form>
	<div id="warning">
	<?php
			if(isset($_SESSION['blad']))
				echo $_SESSION['blad'];

		?>
</div>
	
</div>
	
</div>

<img class="ilustracja"  src="bg.svg">



</body>
<body>




	
		


</body>
</html>