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
<a class="button" style='float: right;margin-bottom:10px;font-size: 12px; background-color:black; color:white; border-color:black;text-decoration: none' href="stan.php?sort=desc">Od najnowszych</a>
<a class="button" style='float: right;font-size: 12px; background-color:black; color:white; border-color:black; margin-right:20px; text-decoration: none; margin-right:0px;'href="stan.php?sort=asc">Od najstarszych</a>

   </div>

            <div class="table-responsive bs-example widget-shadow">
						
			<table class="table table-bordered"> <thead> <tr> <th>ID</th> <th>Nazwa</th> <th>Typ</th> <th>Numer indeksu</th> <th>Ilość</th> <th>Producent</th> </tr> </thead> <tbody>
            
	
	
                <?php
              $email=$_SESSION['email'];


   $sort=$_GET['sort'];
   $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                    $wynik=mysqli_query($polaczenie,"SELECT produkt.idProdukt, produkt.nazwa, produkt.typ, produkt.nr_indeksu, produkt.ilosc, produkt.producent from ((((produkt inner join produkt_has_skladowanie on produkt.idProdukt=produkt_has_skladowanie.Produkt_idProdukt) inner join skladowanie on skladowanie.idSkladowanie=produkt_has_skladowanie.Skladowanie_idSkladowanie) inner join magazyn on magazyn.idmagazyn=skladowanie.magazyn_idmagazyn) INNER join pracownik on pracownik.magazyn_idmagazyn=magazyn.idmagazyn) where pracownik.email='$email' ORDER BY produkt.idProdukt $sort");
                
                $licz=1;
                while ($rekord=mysqli_fetch_array($wynik)) {
                ?>
			<tr> <th scope="row"><?php  echo $rekord['idProdukt'];?></th> 
            <td><?php  echo $rekord['nazwa'];?></td>
            <td><?php  echo $rekord['typ'];?></td>
            <td><?php  echo $rekord['nr_indeksu'];?></td>
            <td><?php  echo $rekord['ilosc'];?></td>
            <td><?php  echo $rekord['producent'];?></td> 
  <?php 
            $licz=$licz+1;
}?></tbody> </table> 
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
