<?php
    session_start();
    error_reporting(0);


    include('connect.php');


    
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
    
    }
    if(isset($_POST['submit']))
     {
        $wszystko_OK=true;
        $haslo_old = $_POST['haslo_old'];
		$haslo_new = $_POST['haslo_new'];
        $haslo_new2 = $_POST['haslo_new2'];
        $user_id=$_SESSION['idProfil'];
        //Sprawdź poprawność hasła
	
		
		if ((strlen($haslo_new)<8) || (strlen($haslo_new)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo_new!=$haslo_new2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	
        if ($haslo_old==$haslo_new)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Nowe hasło nie może być takie jak stare!";
		}	
        $haslo_hash = password_hash($haslo_new, PASSWORD_DEFAULT);
        $haslo_hash_old = password_hash($haslo_old, PASSWORD_DEFAULT);
        
        if ($wszystko_OK==true){
        $query=mysqli_query($polaczenie,"select haslo from pracownik where idProfil='$user_id'");
        $row=mysqli_fetch_array($query);
        if (password_verify($haslo_old, $row['haslo'])){
        
        $ret=mysqli_query($polaczenie,"UPDATE pracownik SET haslo='$haslo_hash' WHERE idProfil='$user_id'");
        $wiadomosc= "Hasło zostało zmienione!"; 
        } else {

        $_SESSION['e_haslo']="Podałeś błędne hasło!";
        }   
    }

    
    
  
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
<section id="pole">
<h3 class="title1 text-center py-3">Zmień hasło</h3>
<form method="post">
    <p style="font-size:16px; color:red ;text-align: center;"> 
    <?php if($wiadomosc){
    echo $wiadomosc;}
   ?> </p>
  <?php
  $user_id=$_SESSION['idProfil'];


?>                                                                              
<div id="panel" style="margin-top:0px;height:380px;">
    <label for="password">Podaj stare hasło:</label>
    <input type="password"  name="haslo_old" id="password">
        
        
    <label for="password">Nowe hasło:</label>
    <input type="password"  name="haslo_new" id="password">
        
        	
        
    <label for="password">Powtórz hasło:</label>
    <input type="password" 
        name="haslo_new2" id="password" >

        <?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error" style="color:red; font-size:13px;">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
        ?>
 

 <button type="submit" name="submit" class="button" style="float:right; background-color:#3a3768; color:white; border-color:#3a3768; margin-top:20px;margin-right:20px;"><span>Aktualizuj</span></button> </form> 
</section>
</div>
	
</body>
</html>