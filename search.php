<?php
session_start();
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


<body>

<div id="pole_stan">
   <h3 class="title1 text-center py-3">Stan magazynowy</h3>
   <div class="search">
  <!-- <span class="text">Sprawdź stan magazynowy danego produktu</span>
   <input type="text" placeholder="Wprowadź indeks lub nazwe produktu">
   <button><i class="fa fa-search"></i></button>
   -->
        <form action="search.php" method="POST">			<!-- Wywołanie funkcji szukaj z przeslaniem GET aby kontynuuowac w innym pliku -->
    
			Podaj numer indeksu: 	<input type="text" name="query" /> <input type="submit" value="Wyszukaj" />
			
	    </form>

   </div>



<div class="result">
   <?php

	//////////////////////////////////////////////////////////
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if ($polaczenie->connect_errno!=0) die ("Error: ".$polaczenie->connect_errno);
$output='';

$id = $_POST['query']; 
  
            

    $query= "SELECT produkt.idProdukt, produkt.nazwa, produkt.typ, produkt.nr_indeksu, produkt.ilosc, produkt.producent, skladowanie.rzad,skladowanie.miejsce_poziom,skladowanie.miejsce_pion, magazyn.nazwa_magazyn from (((produkt inner join produkt_has_skladowanie on produkt.idProdukt=produkt_has_skladowanie.Produkt_idProdukt) inner join skladowanie on skladowanie.idSkladowanie=produkt_has_skladowanie.Skladowanie_idSkladowanie) inner join magazyn on magazyn.idmagazyn=skladowanie.magazyn_idmagazyn) WHERE produkt.nr_indeksu  LIKE '%".$id."%' ";
	  
	 $wynik = $polaczenie->query($query);
	if(!$wynik) die ("Brak dostępu do bazy danych.");
	$ile_znalezionych = $wynik->num_rows;
	if ($ile_znalezionych > 0)
	{   
	echo '<div style=" font-size:20px; text-align:center; margin-top:15px;">'."Dane poszukiwanego produktu".'</div>'; //dodanie paska z historia wizyt
	 while($results = $wynik->fetch_array($ile_znalezionych))
		{    
            for($i=0; $i < $ile_znalezionych; $i++){    
			$output.= "<p><h2>"."ID: ".$results['idProdukt']."</h2>"."Nazwa: ".$results['nazwa']."<br>Typ: ".$results['typ']."<br>Numer indeksu: ".$results['nr_indeksu']."<br>Ilość: ".$results['ilosc']."<br />Producent: ".$results['producent'].	"<br />Magazyn: ".$results['nazwa_magazyn']."<br />Rząd: ".$results['rzad']."<br />Miejsce_poziom: ".$results['miejsce_poziom']."<br />Miejsce_pion: ".$results['miejsce_pion']."</p>";
            }
		
		}
		echo $output;
 echo "<form action='lokalizacjaproduktu.php' method='POST'>
            <input type='hidden' name='query' value='$id'/>
            <br /> <input type='submit' style='width: 200px;'value='Zmien lokalizacje produktu' />
            </form>";

            echo "<form action='edit.php' method='POST'>
            <input type='hidden' name='query' value='$id'/>
            <br /> <input type='submit' value='Edytuj produkt' />
            </form>";
	}
	else 
	{
		echo "Nie znaleziono produktu.";
	}


?>
</div>
  

   </div>
   </div>


   <script>
   
   $(document).ready(function(){
       $('#query').keyup(function(){

      
       var txt=$(this).val();
       if(txt != ''){


       }
       else{
           $('#result').html('');
           $.ajax({
               url:"search.php",
               method:"post",
               data:{query:txt},
               dataType:"text",
               success:function(data){
                   $('#result').html(data);
               }
           });
       }
   });
});
   </script>


</body>



</html>