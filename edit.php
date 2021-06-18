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




            
            $query="SELECT idProdukt, nazwa, typ, nr_indeksu, producent FROM produkt WHERE nr_indeksu='$ind'";
            $wynik = $polaczenie->query($query);
            if(!$wynik) die ("Brak dostępu do bazy danych.");
            $ile_znalezionych = $wynik->num_rows;
            
            while($row = $wynik->fetch_assoc()) 
            {
            $id = $row['idProdukt'];
            $nazwa = $row['nazwa'];
            $typ = $row['typ'];
            $nr_indeksu = $row['nr_indeksu'];
            $producent = $row['producent'];
            }


echo ' <br>
		<form action="edit.php" method="post">
		<input type="hidden" name="save" value="True">
		<input type="hidden" name="ud_id" value="'.$id.'" >
	Nazwa:  		<br />	
		<input type="text" 	name="ud_nazwa" value= "'.$nazwa.'" 	><br>
	Typ: 	<br />	
		<input type="text" 	name="ud_typ"  value= "'.$typ.'" 	><br>
	Producent:		<br />	
		<input type="text"	name="ud_producent" 	value= "'.$producent.'" ><br>
	Numer indeksu: <br />
		<input type="text" 	name="ud_nrindeksu" value= "'.$nr_indeksu.'" minlenght=5><br>
		<input type="Submit" style="margin-top:12px; width:150px;" value="Zaktualizuj dane">
			</form><br>';
			
$ud_id=$_POST['ud_id'];			
$ud_nazwa=$_POST['ud_nazwa'];
$ud_typ=$_POST['ud_typ'];
$ud_producent=$_POST['ud_producent'];
$ud_nrindeksu=$_POST['ud_nrindeksu'];


	If (isset($_POST['save'])  == 'True')  //sprawdzenie czy formularz zostal wyslany jak tak to przechodzimy dalej
{
		
																						//  sprawdzamy czy pola zostaly wypelnione
	if(isset ($_POST['ud_nazwa']) && $_POST['ud_nazwa']{1} && (isset ($_POST['ud_typ']) && $_POST['ud_typ']{2})
			&& (isset ($_POST['ud_producent']) && $_POST['ud_producent']{1}) && (isset ($_POST['ud_nrindeksu']) && $_POST['ud_nrindeksu']{1})) 
	{

		require_once "connect.php";
		$pol = @new mysqli($host, $db_user, $db_password, $db_name);
		if($pol->connect_error) die ("Połączenie z bazą niepowiodło się.");

	$query="UPDATE produkt SET nazwa='$ud_nazwa', typ='$ud_typ', producent='$ud_producent', nr_indeksu='$ud_nrindeksu' WHERE idProdukt='$ud_id'";

	$efekt =$pol->query($query);
	if ($efekt) 
    {
        ?>
    <script type="text/javascript">
    location.href="stan.php";
    </script>
    <?php
    }
	}  else 
		{ echo 'Pole nie może być puste & indeks musi skłądać się z 5 cyfr!';}
			
} 




?></tbody> </table> 
					</div>
                    
                </div>
   </div>

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