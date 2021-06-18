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

</div>
  

  <?php 


require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if ($polaczenie->connect_errno!=0) die ("Error: ".$polaczenie->connect_errno);
$output='';

$ind = $_POST['query']; 




            
            $query="SELECT produkt.idProdukt, produkt.nr_indeksu, skladowanie.rzad,skladowanie.miejsce_poziom,skladowanie.miejsce_pion, magazyn.nazwa_magazyn from (((produkt inner join produkt_has_skladowanie on produkt.idProdukt=produkt_has_skladowanie.Produkt_idProdukt) inner join skladowanie on skladowanie.idSkladowanie=produkt_has_skladowanie.Skladowanie_idSkladowanie) inner join magazyn on magazyn.idmagazyn=skladowanie.magazyn_idmagazyn) WHERE produkt.nr_indeksu  = '$ind'";
            $wynik = $polaczenie->query($query);
            if(!$wynik) die ("Brak dostępu do bazy danych.");
            $ile_znalezionych = $wynik->num_rows;
            
            while($row = $wynik->fetch_assoc()) 
            {
				//pobiera id produktu na ktorym pracuje
			$idpr = $row['idProdukt']; 
            $nr_indeksu = $row['nr_indeksu'];
            $rzad = $row['rzad'];
            $miejsce_poziom = $row['miejsce_poziom'];
            $miejsce_pion = $row['miejsce_pion'];
            $magazyn = $row['nazwa_magazyn'];
            }
            
            
echo '<br>'; 

echo '<div style=" font-size:20px; text-align:center; margin-top:15px;">'."Produkt o numerze_ineksu: ".'<b>'.$nr_indeksu.'</b>'." znajduje się w: ".'<b>'.$magazyn.'</b>'." ".'</div>';  



?>

<form action="lokalizacjaproduktu.php" method="post" >
<input type="hidden" name="save" value="True">
<input type="hidden" name="ud_id" value="<?php echo $idpr; ?>" >
<label for="rzad">Rzad</label>
<select name="newrzad">
    <option selected>Rząd <?php echo $rzad; ?> </option>
                <option value="1">Rząd 1</option>
				<option value="2">Rząd 2</option>
				<option value="3">Rząd 3</option>
                <option value="4">Rząd 4</option>
				<option value="5">Rząd 5</option>
				<option value="6">Rząd 6</option>
                <option value="7">Rząd 7</option>
				<option value="8">Rząd 8</option>
				<option value="9">Rząd 9</option>
                <option value="10">Rząd 10</option>
    </select>
<br>
<label for="miejscepion">Miejsce pion</label>
<select name="newpion">
  <option selected>Miejsce <?php echo $miejsce_pion; ?> </option>
  <option value="1">Pion 1</option>
				<option value="2">Pion 2</option>
				<option value="3">Pion 3</option>
                <option value="4">Pion 4</option>
				<option value="5">Pion 5</option>
				<option value="6">Pion 6</option>
                <option value="7">Pion 7</option>
				<option value="8">Pion 8</option>
				<option value="9">Pion 9</option>
                <option value="10">Pion 10</option>
</select>
</br>
<label for="miejscepoz">Miejsce poziom</label>
<select name="newpoz" >
  <option selected>Poziom <?php echo $miejsce_poziom; ?> </option>
  <option value="1">Poziom 1</option>
				<option value="2">Poziom 2</option>
				<option value="3">Poziom 3</option>
                <option value="4">Poziom 4</option>
</select>
<br>
<br>
<input type="Submit" style='width: 200px;' value="Zmien lokalizacje">
</form>



<?php


    $ud_id=$_POST['ud_id'];	
$nrzad = $_POST['newrzad'];			
$npoz = $_POST['newpoz'];
$npion = $_POST['newpion'];




echo $ud_id;

if (isset($_POST['save'])  == 'True')  //sprawdzenie czy formularz zostal wyslany jak tak to przechodzimy dalej
{

		require_once "connect.php";
		$pol = @new mysqli($host, $db_user, $db_password, $db_name);
		if($pol->connect_error) die ("Połączenie z bazą niepowiodło się.");
	//pobiera na podstawie id produktu, id jego skladowania 
    $query1 = "UPDATE skladowanie SET rzad = '$nrzad' , miejsce_poziom = '$npoz' , miejsce_pion = '$npion' WHERE idskladowanie = '$ud_id'";
    $efekt1 = $pol->query($query1);
        
	if ($efekt1) 
    {
        ?>
    <script type="text/javascript">
    location.href="stan.php";
    </script>
    <?php
    } else
    echo "Błąd";
	
	
			
} 




?>
</body> </table> 
					</div>
                    
                </div>
   </div>

   </div>
   </div>
   </div>

?>
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