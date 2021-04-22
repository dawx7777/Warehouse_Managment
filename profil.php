<?php
session_start();

	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap" rel="stylesheet">
    <link href="simple-sidebar.css" rel="stylesheet">
</head>

<body style="background-image: radial-gradient( circle farthest-corner at 1.3% 2.8%,  rgba(239,249,249,1) 0%, rgba(182,199,226,1) 100.2% );">
<?php include_once('szkielet.php');?>



<body>

<section id="team" style="background-color: transparent; box-shadow: none;font-family: 'Poppins', sans-serif;">

			<div class="container my-3 py-5 text-center">
				

				<div class="row">
					
					<div class="col-lg-4 col-md-6">
						<div class="card">
							<div class="card-body">
								<img src="" alt="" class="img-fluid rounded-circle w-50 mb-3">
								<h3>Moje konto</h3></br>
								<p>Jesteś zalogowany jako <b><?php echo " ".$_SESSION['stanowisko']."."; ?> </b></p>
									<p><b>Email:</b> <?php echo "".$_SESSION['email'].""; ?></p>
									 
										</div>
										</div>
										</div>
				
				<div class="col-lg-4 col-md-6">
						<div class="card">
							<div class="card-body">
								<img src="" alt="" class="img-fluid rounded-circle w-50 mb-3">
								<h3>Zarejestruj pracownika</h3>
								
								<p></p>
								<div class="d-flex flex-row justify-content-center">
									<div class="p-4">
									<form action="rejestracja.php" method="post">
									 <input type="submit" value="Utwórz konto" />
									</form>		
										
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
</section>					


</body>
</html>