<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    
}
?>
<?php
if(isset($_POST['nr_index']))
{
    
                                                
     $wszystko_OK=true;
             

        $produkt = $_POST['produkt_nazwa'];
		 $rodzaj = $_POST['rodzaj'];
         $nr_index = $_POST['nr_index'];
         $ilosc = $_POST['ilosc'];
         $producent = $_POST['producent'];
													
		 if($produkt == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_produkt_nazwa']="Nie wprowadzono danych!";
		}
		if($rodzaj == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_rodzaj']="Nie wprowadzono danych!";
		}
		if($nr_index == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_nr_index']="Nie wprowadzono danych!";
		}

		if($ilosc == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_ilosc']="Nie wprowadzono danych!";
		}



		if($producent == "") 
		{
			 $wszystko_OK=false;
			 $_SESSION['e_producent']="Nie wprowadzono danych!";
		}

        
      
        
                                                   //spawdzenie dlugosci hasla
        if (strlen($nr_index)!=5)
        {
            $wszystko_OK=false;
            $_SESSION['e_nr_index'] = "Numer indeksu musi się składać z 5 cyfr !!";
        }

        $_SESSION['fr_produkt_nazwa'] = $produkt;
		$_SESSION['fr_rodzaj'] = $rodzaj;
		$_SESSION['fr_nr_index'] = $nr_index;
		$_SESSION['fr_ilosc'] = $ilosc;
		$_SESSION['fr_producent'] = $producent;


		
		$magazyn=$_POST['magazyn'];  // z select wybor opcji 
        $rzad=$_POST['rzad'];  // z select wybor opcji 
        $pion=$_POST['pion'];  // z select wybor opcji 
        $poziom=$_POST['poziom'];  // z select wybor opcji 

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
												
			$rezultat = $polaczenie->query("SELECT idProdukt FROM produkt WHERE nr_indeksu='$nr_index';");
           
				
			if(!$rezultat) throw new Exception($polaczenie->error);
				
			$ile_produkt = $rezultat->num_rows;
			if($ile_produkt>0)
		{
				$wszystko_OK=false;
				$_SESSION['e_nr_index']="Istnieje już produkt o tym indeksie, zaktualizuj jego stan!";
		}
            
        
			if($wszystko_OK==true){						
											
			$polaczenie->begin_transaction();
			if($polaczenie->query("INSERT INTO `produkt` (`nazwa`, `typ`, `nr_indeksu`, `ilosc`,  `producent`)
                VALUES ('".$produkt."', '".$rodzaj."', '".$nr_index."', '".$ilosc."', '".$producent."');") &&
                
                ($polaczenie->query("INSERT INTO `skladowanie` (`rzad`, `miejsce_poziom`, `miejsce_pion`, `magazyn_idmagazyn`)
                VALUES ('".$rzad."', '".$poziom."', '".$pion."', '".$magazyn."');")))
			
			{
                $_SESSION['udanarejestracja']=true;
				header('Location: wydawanie.php'); 
			}
            $last_id=mysqli_insert_id($polaczenie);
            $polaczenie->query("INSERT INTO produkt_has_skladowanie () VALUES((SELECT produkt.idProdukt from produkt where nr_indeksu='$nr_index'),$last_id)");

			$polaczenie->commit();
		
			}
        

            $polaczenie->close();
            }

        }
        

        catch(Exception $e)
		{
            $polaczenie->rollback();

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
<style>
#grad1 {
   background-color: white;
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
}

#msform input,
#msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
    margin-left: 100px;
    
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f022"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f041"
}


#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: skyblue
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}

.row{
    display: flex;
}
</style>


<body>

    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Historia operacji</strong></h2>
                <p>Chronologiczna lista wydanych produktów</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                    
                  
                           <form action="wydane.php" method="POST">
                            <button type="submit" style="width: 300px"name="btn_pdf_wydane" class="button"  ><span>Wyświetl historie operacji</span></button>
                           </form>
                           </br></br>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>         

<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});
$(".submit").click(function(){
return false;
});


});
</script>
</body>
</html>