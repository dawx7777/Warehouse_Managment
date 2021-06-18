<?php
session_start();
include('connect.php');
error_reporting(0);
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
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="simple-sidebar.css" rel="stylesheet">
</head>

<body style="background-image: radial-gradient( circle farthest-corner at 1.3% 2.8%,  rgba(239,249,249,1) 0%, rgba(182,199,226,1) 100.2% );">
<?php include_once('szkielet.php');?>
<section id="pole_stan">

<body>
   
  <?php

if(isset($_SESSION['message'])): ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php

echo $_SESSION['message'];
unset($_SESSION['message']);

?>
</div>
<?php endif ?>
  

            <div class="table-responsive bs-example widget-shadow">
						
			<table class="table table-bordered"> <thead> <tr> <th>Imie</th> <th>Nazwisko</th> <th>Prodkukt</th> <th>Ilość</th> <th>Numer indeksu</th> <th>Data</th><th>Status</th><th>Akcja</th>  </tr> </thead> <tbody>
            
	
	
                <?php
             if(isset($_POST['btn_pdf'])){
   
    
    
           


   $sort=$_GET['sort'];
   $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                    $wynik=mysqli_query($polaczenie,"SELECT  produkty_klient.idProdukty_klient, produkty_klient.Nazwa_produktu,produkty_klient.Ilosc, produkty_klient.identyfikator,produkty_klient.status, klient.Imie, klient.Nazwisko,klient.data_wydania from klient inner join produkty_klient on klient.idKlient=produkty_klient.Klient_idKlient where produkty_klient.status='DO WYDANIA'  ORDER BY klient.data_wydania  $sort");
                
                $licz=1;
                while ($rekord=mysqli_fetch_assoc($wynik)) {
                ?>
			<tr> <th scope="row"><?php  echo $rekord['Imie'];?></th> 
            <td><?php  echo $rekord['Nazwisko'];?></td>
            <td><?php  echo $rekord['Nazwa_produktu'];?></td>
            <td><?php  echo $rekord['Ilosc'];?></td>
            <td><?php  echo $rekord['identyfikator'];?></td>
            <td><?php  echo $rekord['data_wydania'];?></td> 
            <td><?php  echo $rekord['status'];?></td> 
            <td> <a 
      href="do_wydania.php?add=<?php echo $rekord['idProdukty_klient']; ?>" class="btn btn-success">WYDAJ</a></td> 
  <?php 
            $licz=$licz+1;
                }
}?></tbody> </table> 

<?php
 if(isset($_GET['add'])){
    $id=$_GET['add'];

    
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->query("UPDATE produkty_klient SET produkty_klient.status='WYDANE' where idProdukty_klient=$id");
    $polaczenie->query("UPDATE produkt inner join produkty_klient on produkt.idProdukt=produkty_klient.Produkt_idProdukt set produkt.ilosc=produkt.ilosc-produkty_klient.Ilosc where produkty_klient.idProdukty_klient=$id");

    $_SESSION['message']="Przedmiot został wydany";
    $_SESSION['msg_type']="SUCCESS";

    header("location:udane_wydanie.php");

 }


?>
					</div>
                    
                </div>

</section>
</body>
</html>