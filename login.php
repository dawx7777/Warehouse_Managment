<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))  //nie jest wprowadzone login haslo  przejdz do panelu logowania
{
	header('Location: index.php');
	exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
	echo "Error: ".$polaczenie->connect_errno;
}
else 
{
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];

	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");


if ($rezultat = @$polaczenie->query(
sprintf("SELECT * FROM pracownik WHERE email='%s';",
mysqli_real_escape_string($polaczenie,$login))))
{
	$ilu_userow = $rezultat->num_rows;   //liczba zwroconych wierszy
	if($ilu_userow>0)    //jesli ilosc userow bedzie wiecej niz  0 to:
	{
		$rows = $rezultat->fetch_assoc();   //
		
		if(password_verify($haslo,$rows['haslo']))
		{
		
			$_SESSION['zalogowany'] = true;
			$_SESSION['idProfil'] = $rows['idProfil'];
			$_SESSION['imie'] = $rows['Imie'];
			$_SESSION['nazwisko'] = $rows['nazwisko'];
			$_SESSION['email']  = $rows['email'];
			$_SESSION['stanowisko'] =$rows['stanowisko'];


			unset($_SESSION['blad']);
			$rezultat->free_result();
			header('Location: profil.php');
			
		
	if($_SESSION['stanowisko'] == 'kierownik') 
    {
        header('Location: profil.php');
    }
        else {

	         header('Location: profilmagazynier.php');
             }
		}
		else 
		{
			$_SESSION['blad'] = '<span>Nieprawidłowy login lub hasło!</span>';
			header('Location: index.php');
		}
		
	}
	else  
	{
		$_SESSION['blad'] = '<span>Nieprawidłowy login lub hasło!</span>';
		header('Location: index.php');

	}
}

	$polaczenie->close(); 
}



?>