<?php
    session_start();
    
    if (($_SESSION['stanowisko']) != 'kierownik')
    {
        header('Location: profilmagazynier.php');
    
	}
	?>
<?php

	
	if(isset($_POST['email']))
	{
		
													//Udana walidacja? TAK
		 $wszystko_OK=true;
		 
													//Sprawdz poprawnosc email
		 $email = $_POST['email'];
		 $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
		 
		 if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		 {
			 $wszystko_OK=false;
			 $_SESSION['e_email']="Podaj poprawny adres e-mail!";
		 }
		 
													//Sprawdznie poprwanosci hasła
		 $haslo1 = $_POST['haslo1'];
		 $haslo2 = $_POST['haslo2'];
		 
													//spawdzenie dlugosci hasla
		 if ((strlen($haslo1)<6) || (strlen($haslo1)>25))
		 {
			 $wszystko_OK=false;
			 $_SESSION['e_haslo'] = "Hasło musi zawierać minimum 6 znaków a maksymalnie 25.";
		 }
		 
		 if($haslo1!=$haslo2)
		 {
			 $wszystko_OK=false;
			 $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		 }
		 
		 $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		 
		 $imie = $_POST['imie'];
		 $nazwisko = $_POST['nazwisko'];
													//sprawdzanie czy imie i nazwisko zostało wypełnione
		 if($imie == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_imie']="Nie wprowadzono danych!";
		}
		if($nazwisko == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_nazwisko']="Nie wprowadzono danych!";
		}
		
		$data_ur = $_POST['data_ur'];


		if($data_ur == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_data_ur']="Nie wprowadzono danych!";
		}
		
													//Zapamietanie wprowadzonych danych
		
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_data_ur'] = $data_ur;
		$_SESSION['fr_haslo1'] = $haslo1;


		$stanowisko=$_POST['stanowisko'];  // z select wybor opcji 
		$magazyn=$_POST['magazyn'];  // z select wybor opcji 
		 
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
												// Czy email juz istnieje 
			$rezultat = $polaczenie->query("SELECT idProfil FROM pracownik WHERE email='$email';");
				
			if(!$rezultat) throw new Exception($polaczenie->error);
				
			$ile_maili = $rezultat->num_rows;
			if($ile_maili>0)
		{
				$wszystko_OK=false;
				$_SESSION['e_email']="Istnieje już konto z podanym adresem email!";
		}
		
		if ($wszystko_OK==true)
		{
											//wszystko sie udalo, DODAJEMY do bazy
											
			
			if ($polaczenie->query("INSERT INTO `pracownik` (`email`, `haslo`, `imie`, `nazwisko`,  `data_ur`, `stanowisko`, `magazyn_idmagazyn`)
                VALUES ('".$email."', '".$haslo_hash."', '".$imie."', '".$nazwisko."', '".$data_ur."', '".$stanowisko."', '".$magazyn."');"))
			
			{
				$_SESSION['udanarejestracja']=true;
				header('Location: udanarejestracja.php');    // przeniesienie do menu glownego
			}
			else
			{
				throw new Exception($polaczenie->error);
			}
			
		}
				
			$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo "Błąd serwera.";
echo '<br />Informacja o blędzie: ',$e;
		}
		
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rejestracja</title>
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
<div id="logowanie">
<img class="wave" src="wave.png">
		<div class="img_log">
			
		<div id="panel" style="margin-left:50px;">
	<form method="post">
	<label for="username">Imię:</label>
	<input type="text" value="<?php
			if (isset($_SESSION['fr_imie']))
			{
				echo $_SESSION['fr_imie'];
				unset($_SESSION['fr_imie']);
			}
        ?>"
        name="imie" id="input1" >

        <?php
			if (isset($_SESSION['e_imie']))
			{
				echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
				unset($_SESSION['e_imie']);
			}
        ?>
    <label for="password">Nazwisko:</label>
    <input type="text" value="<?php
			if (isset($_SESSION['fr_nazwisko']))
			{
				echo $_SESSION['fr_nazwisko'];
				unset($_SESSION['fr_nazwisko']);
			}
        ?>" name="nazwisko" id="input1">
        
        <?php
			if (isset($_SESSION['e_nazwisko']))
			{
				echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
				unset($_SESSION['e_nazwisko']);
			}
		?>
	<label for="password">Email:</label>
    <input type="text"  value="<?php
	if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
        ?>" name="email" id="input1">
	<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
        ?>		
    
	<label for="password">Data urodzenia:</label>
    <input type="DATE" value="<?php
			if (isset($_SESSION['fr_data_ur']))
			{
				echo $_SESSION['fr_data_ur'];
				unset($_SESSION['fr_data_ur']);
			}
        ?>" name="data_ur" id="password">
        
        <?php
			if (isset($_SESSION['e_data_ur']))
			{
				echo '<div class="error">'.$_SESSION['e_data_ur'].'</div>';
				unset($_SESSION['e_data_ur']);
			}
        ?>		
        <label for="password">Hasło:</label>
			<input type="password" value="<?php			
			
			if(isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset ($_SESSION['fr_haslo1']);
			} ?>" name="haslo1" id="password" >
			<?php
			if(isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
			?>
    <label for="password">Powtórz hasło:</label>
    <input type="password" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
        ?>" 
        name="haslo2" id="password" >
	<label for="password">Wybór stanowiska:</label>	
			<select name="stanowisko" id="input1">
				<option value="Kierownik">Kierownik</option>
				<option value="Magazynier">Magazynier</option>
			</select>
	
			<label for="password">Wybór magazynu:</label>	

			<select name="magazyn" id="input1">
				<option value="1">Magazyn 1</option>
				<option value="2">Magazyn 2</option>
				<option value="3">Magazyn 3</option>
			</select>

    
	<div id="lower2">
	<input type="checkbox" name="regulamin" <?php
			if (isset($_SESSION['fr_regulamin']))
			{
				echo "checked";
				unset($_SESSION['fr_regulamin']);
			}
                ?>/><label class="check" for="checkbox">Akceptuje polityke prywatności!</label>
                
            <?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
            ?>	
        </div>
		<div id="lower">    
	<input type="submit" value="Zarejestruj" style="margin-left:-67px; float:right;">
	</label>
	</div>
	</form>
	
	</div>	
		</div>
<img class="ilustracja2"  src="sign_in.svg">


		
</body>
</html>